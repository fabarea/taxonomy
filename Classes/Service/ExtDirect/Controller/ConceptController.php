<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2011 Fabien Udriot <fabien.udriot@ecodev.ch>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*  A copy is found in the textfile GPL.txt and important notices to the license
*  from the author is found in LICENSE.txt distributed with these scripts.
*
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

/**
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Taxonomy_Service_ExtDirect_Controller_ConceptController extends Tx_Extbase_MVC_Controller_ActionController {
	
	/**
	 * Update an existing 
	 *
	 * @param int $nodeId
	 * @return sting
	 */
	public function edit($nodeId) {
		$this->initializeTemplateContainer();
		$this->initializeTCEforms();

		// Creating the editing form, wrap it with buttons, document selector etc.
		$this->editconf = array(
			'tx_taxonomy_domain_model_concept' => array('1' => 'edit'),
		);
		$editForm = $this->makeEditForm();
		return $editForm;
		
	}
	
	/**
	 * Initializes an anonymous template container.
	 * The created container can be compared to alt_doc.php in backend-only disposal.
	 *
	 * @return	void
	 * @todo: should be put somewhere else...
	 */
	protected function initializeTCEforms() {
		global $BE_USER,$LANG,$TCA;
		
			// Initialize TCEforms (rendering the forms)
		$this->tceforms = t3lib_div::makeInstance('t3lib_TCEforms');
		$this->tceforms->initDefaultBEMode();
		$this->tceforms->doSaveFieldName = 'doSave';
		$this->tceforms->localizationMode = t3lib_div::inList('text,media',$this->localizationMode) ? $this->localizationMode : '';	// text,media is keywords defined in TYPO3 Core API..., see "l10n_cat"
		$this->tceforms->returnUrl = $this->R_URI;
		$this->tceforms->palettesCollapsed = !$this->MOD_SETTINGS['showPalettes'];
		$this->tceforms->disableRTE = !$BE_USER->isRTE();
		$this->tceforms->enableClickMenu = TRUE;
		$this->tceforms->enableTabMenu = TRUE;

			// Clipboard is initialized:
		$this->tceforms->clipObj = t3lib_div::makeInstance('t3lib_clipboard');		// Start clipboard
		$this->tceforms->clipObj->initializeClipboard();	// Initialize - reads the clipboard content from the user session

			// Setting external variables:
		$this->tceforms->edit_showFieldHelp = $BE_USER->uc['edit_showFieldHelp'];
	}
	
	/**
	 * Initializes an anonymous template container.
	 * The created container can be compared to alt_doc.php in backend-only disposal.
	 *
	 * @return	void
	 * @todo: should be put somewhere else...
	 */
	protected function initializeTemplateContainer() {
		t3lib_div::requireOnce(PATH_typo3 . 'template.php');
		$GLOBALS['TBE_TEMPLATE'] = t3lib_div::makeInstance('template');
		$GLOBALS['TBE_TEMPLATE']->getPageRenderer()->addInlineSetting(
			'', 'PATH_typo3', t3lib_div::dirname(t3lib_div::getIndpEnv('SCRIPT_NAME')) . '/' . TYPO3_mainDir
		);

		$GLOBALS['SOBE'] = new stdClass();
		$GLOBALS['SOBE']->doc = $GLOBALS['TBE_TEMPLATE'];
	}
	
	/**
	 * Creates the editing form with TCEforms, based on the input from GPvars.
	 *
	 * @return	string		HTML form elements wrapped in tables
	 * @todo: should be put somewhere else...
	 */
	protected function makeEditForm()	{
		global $BE_USER,$LANG,$TCA;

		// Initialize variables:
		$this->elementsData=array();
		$this->errorC=0;
		$this->newC=0;
		$thePrevUid='';
		$editForm='';
		$trData = NULL;
		
		// Traverse the GPvar edit array
		foreach($this->editconf as $table => $conf)	{	// Tables:
			
			if (is_array($conf) && $TCA[$table] && $BE_USER->check('tables_modify',$table))	{

					// Traverse the keys/comments of each table (keys can be a commalist of uids)
				foreach($conf as $cKey => $cmd)	{
					if ($cmd=='edit' || $cmd=='new')	{

							// Get the ids:
						$ids = t3lib_div::trimExplode(',',$cKey,1);


						// Traverse the ids:
						foreach($ids as $theUid)	{

								// Checking if the user has permissions? (Only working as a precaution, because the final permission check is always down in TCE. But it's good to notify the user on beforehand...)
								// First, resetting flags.
							$hasAccess = 1;
							$deniedAccessReason = '';
							$deleteAccess = 0;
							$this->viewId = 0;

								// If the command is to create a NEW record...:
							if ($cmd=='new')	{
								if (intval($theUid))	{		// NOTICE: the id values in this case points to the page uid onto which the record should be create OR (if the id is negativ) to a record from the same table AFTER which to create the record.

										// Find parent page on which the new record reside
									if ($theUid<0)	{	// Less than zero - find parent page
										$calcPRec=t3lib_BEfunc::getRecord($table,abs($theUid));
										$calcPRec=t3lib_BEfunc::getRecord('pages',$calcPRec['pid']);
									} else {	// always a page
										$calcPRec=t3lib_BEfunc::getRecord('pages',abs($theUid));
									}

										// Now, calculate whether the user has access to creating new records on this position:
									if (is_array($calcPRec))	{
										$CALC_PERMS = $BE_USER->calcPerms($calcPRec);	// Permissions for the parent page
										if ($table=='pages')	{	// If pages:
											$hasAccess = $CALC_PERMS&8 ? 1 : 0;
											#$this->viewId = $calcPRec['pid'];
											$this->viewId = 0;
										} else {
											$hasAccess = $CALC_PERMS&16 ? 1 : 0;
											$this->viewId = $calcPRec['uid'];
										}
									}
								}
								$this->dontStoreDocumentRef=1;		// Don't save this document title in the document selector if the document is new.
							} else {	// Edit:
								$calcPRec = t3lib_BEfunc::getRecord($table,$theUid);
								t3lib_BEfunc::fixVersioningPid($table,$calcPRec);
								if (is_array($calcPRec))	{
									if ($table=='pages')	{	// If pages:
										$CALC_PERMS = $BE_USER->calcPerms($calcPRec);
										$hasAccess = $CALC_PERMS&2 ? 1 : 0;
										$deleteAccess = $CALC_PERMS&4 ? 1 : 0;
										$this->viewId = $calcPRec['uid'];
									} else {
										$CALC_PERMS = $BE_USER->calcPerms(t3lib_BEfunc::getRecord('pages',$calcPRec['pid']));	// Fetching pid-record first.
										$hasAccess = $CALC_PERMS&16 ? 1 : 0;
										$deleteAccess = $CALC_PERMS&16 ? 1 : 0;
										$this->viewId = $calcPRec['pid'];

											// Adding "&L=xx" if the record being edited has a languageField with a value larger than zero!
										if ($TCA[$table]['ctrl']['languageField'] && $calcPRec[$TCA[$table]['ctrl']['languageField']]>0)	{
											$this->viewId_addParams = '&L='.$calcPRec[$TCA[$table]['ctrl']['languageField']];
										}
									}

										// Check internals regarding access:
									if ($hasAccess)	{
										$hasAccess = $BE_USER->recordEditAccessInternals($table, $calcPRec);
										$deniedAccessReason = $BE_USER->errorMsg;
									}
								} else $hasAccess = 0;
							}

							if (is_array($GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['typo3/alt_doc.php']['makeEditForm_accessCheck']))	{
								foreach ($GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['typo3/alt_doc.php']['makeEditForm_accessCheck'] as $_funcRef)	{
									$_params = array(
										'table' 	=>	$table,
										'uid' 		=> 	$theUid,
										'cmd' 		=> 	$cmd,
										'hasAccess' => $hasAccess
									);
									$hasAccess = t3lib_div::callUserFunction($_funcRef, $_params, $this);
								}
							}

							// AT THIS POINT we have checked the access status of the editing/creation of records and we can now proceed with creating the form elements:

							if ($hasAccess)	{
								$prevPageID = is_object($trData)?$trData->prevPageID:'';
								$trData = t3lib_div::makeInstance('t3lib_transferData');
								$trData->addRawData = TRUE;
								$trData->defVals = $this->defVals;
								$trData->lockRecords=1;
								$trData->disableRTE = !$BE_USER->isRTE();
								$trData->prevPageID = $prevPageID;
								$trData->fetchRecord($table,$theUid,$cmd=='new'?'new':'');	// 'new'
								reset($trData->regTableItems_data);
								$rec = current($trData->regTableItems_data);
								$rec['uid'] = $cmd=='new' ? uniqid('NEW') : $theUid;
								if ($cmd=='new')	{
									$rec['pid'] = $theUid=='prev'?$thePrevUid:$theUid;
								}
								$this->elementsData[]=array(
									'table' => $table,
									'uid' => $rec['uid'],
									'pid' => $rec['pid'],
									'cmd' => $cmd,
									'deleteAccess' => $deleteAccess
								);

									// Now, render the form:
								if (is_array($rec))	{

										// Setting visual path / title of form:
									$this->generalPathOfForm = $this->tceforms->getRecordPath($table,$rec);
									if (!$this->storeTitle)	{
										$this->storeTitle = $this->recTitle ? htmlspecialchars($this->recTitle) : t3lib_BEfunc::getRecordTitle($table,$rec,TRUE);
									}

										// Setting variables in TCEforms object:
									$this->tceforms->hiddenFieldList = '';
									$this->tceforms->globalShowHelp = $this->disHelp ? 0 : 1;
									if (is_array($this->overrideVals[$table]))	{
										$this->tceforms->hiddenFieldListArr = array_keys($this->overrideVals[$table]);
									}

										// Register default language labels, if any:
									$this->tceforms->registerDefaultLanguageData($table,$rec);

										// Create form for the record (either specific list of fields or the whole record):
									$panel = '';
									if ($this->columnsOnly)	{
										if(is_array($this->columnsOnly)){
											$panel.= $this->tceforms->getListedFields($table,$rec,$this->columnsOnly[$table]);
										} else {
											$panel.= $this->tceforms->getListedFields($table,$rec,$this->columnsOnly);
										}
									} else {
										$panel.= $this->tceforms->getMainFields($table,$rec);
									}
									$panel = $this->tceforms->wrapTotal($panel,$rec,$table);

										// Setting the pid value for new records:
									if ($cmd=='new')	{
										$panel.= '<input type="hidden" name="data['.$table.']['.$rec['uid'].'][pid]" value="'.$rec['pid'].'" />';
										$this->newC++;
									}

										// Display "is-locked" message:
									if ($lockInfo = t3lib_BEfunc::isRecordLocked($table, $rec['uid'])) {
										$lockedMessage = t3lib_div::makeInstance(
											't3lib_FlashMessage',
											htmlspecialchars($lockInfo['msg']),
											'',
											t3lib_FlashMessage::WARNING
										);
										t3lib_FlashMessageQueue::addMessage($lockedMessage);
									}

										// Combine it all:
									$editForm .= $panel;
								}

								$thePrevUid = $rec['uid'];
							} else {
								$this->errorC++;
								$editForm.=$LANG->sL('LLL:EXT:lang/locallang_core.php:labels.noEditPermission',1).'<br /><br />'.
									($deniedAccessReason ? 'Reason: ' . htmlspecialchars($deniedAccessReason) . '<br /><br />' : '');
							}
						}
					}
				}
			}
		}

		return $editForm;
	}
	
	/**
	 * Fetches the next tree level
	 *
	 * @param int $nodeId
	 * @param stdClass $nodeData
	 * @return array
	 */
	public function getNextTreeLevel($nodeId) {
		
		$values[] = Array(
			'text' => 'To Do3',
			'cls' => 'folder',
			'expanded' => false,
		);

		$values[] = Array(
			'text' => 'To Do2',
			'cls' => 'folder',
			'expanded' => false,
		);
		#return $values;
		
		/** @var $tree Tx_Taxonomy_Service_ExtDirect_Controller_Tree */
		$tree = t3lib_div::makeInstance('Tx_Taxonomy_Service_ExtDirect_Controller_Tree');
		return $tree->getNextTreeLevel($nodeId);
	}
//	
//	/**
//	 * Return the record type for a node
//	 *
//	 * @param int $nodeId
//	 * @param stdClass $nodeData
//	 * @return array $content
//	 */
//	public function getRecordType($nodeId, $nodeData) {
//		$values = array(
//			'tt_news',
//			'tt_content',
//		);
//		return $values;
//	}
//
//
//	/**
//	 * Loads repositories
//	 *
//	 * @return array
//	 */
//	public function getRecords() {
//		//$settings = $this->getSettings();
//		//$repositories = tx_em_Database::getRepositories();
//		$records = array(
//			1 => array (
//				'uid' => '1',
//				'title' => 'Lorem Ipsum 1',
//			),
//			2 => array (
//				'uid' => '2',
//				'title' => 'Lorem Ipsum 2',
//			)
//		);
//
//		$data = array();
//
//		foreach ($records as $uid => $record) {
//			$data[] = array(
//				'title' => $record['title'],
//				'uid' => $record['uid'],
////				'description' => $repository['description'],
////				'wsdl_url' => $repository['wsdl_url'],
////				'mirror_url' => $repository['mirror_url'],
////				'count' => $repository['extCount'],
////				'updated' => $repository['lastUpdated'] ? date('d/m/Y H:i', $repository['lastUpdated']) : 'never',
////				'selected' => $repository['uid'] === $settings['selectedRepository'],
//			);
//		}
//
//		$metaData['fields'] = array(
//			array('name' => 'uid', 'type' => 'int'),
//			array('name' => 'title', 'type' => 'string'),
//		);
//
//
//		return array(
//			'total' => count($data),
//			'metaData' => $metaData,
//			'data' => $data,
//		);
//	}
//
//	/**
//	 * Loads repositories
//	 *
//	 * @return array
//	 */
//	public function getRepositories() {
//		//$settings = $this->getSettings();
//		//$repositories = tx_em_Database::getRepositories();
//		$records = array(
//			1 => array (
//				'uid' => '1',
//				'title' => 'tt_news',
//			),
//			2 => array (
//				'uid' => '2',
//				'title' => 'tt_content',
//			)
//		);
//		
//		$data = array();
//
//		foreach ($records as $uid => $record) {
//			$data[] = array(
//				'title' => $record['title'],
//				'uid' => $record['uid'],
////				'description' => $repository['description'],
////				'wsdl_url' => $repository['wsdl_url'],
////				'mirror_url' => $repository['mirror_url'],
////				'count' => $repository['extCount'],
////				'updated' => $repository['lastUpdated'] ? date('d/m/Y H:i', $repository['lastUpdated']) : 'never',
////				'selected' => $repository['uid'] === $settings['selectedRepository'],
//			);
//		}
//
//		return array(
//			'length' => count($data),
//			'data' => $data,
//		);
//	}
//	
//	/**
//	 * Inserts a new node as the first child node of the destination node and returns the created node.
//	 *
//	 * @param stdClass $parentNodeData
//	 * @param int $pageType
//	 * @return array
//	 */
//	public function insertNodeToFirstChildOfDestination($parentNodeData, $pageType) {
//		
//		/* ********************************** */
//		// Save a new concept
//		#$GLOBALS['TSFE'] = t3lib_div::makeInstance('tslib_fe', $GLOBALS['TYPO3_CONF_VARS'], 0, 0);
//		#$GLOBALS['TSFE']->sys_page = t3lib_div::makeInstance('t3lib_pageSelect');
//		// get instance of object manager
//		$objectManger = t3lib_div::makeInstance('Tx_Extbase_Object_ObjectManager');
//
//		// Init repository
//		$conceptRepository = $objectManger->get('Tx_Taxonomy_Domain_Repository_ConceptRepository');
//
//		// Init Model
//		$concept = $objectManger->get('Tx_Taxonomy_Domain_Model_Concept');
//		#$concept->
//
//		// Add concept to the repository
//		$conceptRepository->add($concept);
//
//		// save changes back to tables. needed only when you are expecting something to be saved back to db table. No need for read only access
//		$objectManger->get('Tx_Extbase_Persistence_Manager')->persistAll(); 
//
//		
//		
//		
//		/* ********************************** */
//		// make sure identity has been set
//		$identityMap = t3lib_div::makeInstance('Tx_Identity_Map');
//		
//			// Update UUID values
//		$identityMap->rebuild();
//		$identityMap->commit();
//		
//
//		
//		/* ********************************** */
//		/* Add relation with the parent object */
//		if ((int) $parentNodeData->id > 0) {
////			define('EF_PATH_ROOT', PATH_site);
////			define('EF_PATH_FRAMEWORK', t3lib_extmgm::extPath('taxonomy') . 'Resources/PHP/Libraries/Erfurt/');
////			define('EF_PATH_CONFIGURATION', t3lib_extmgm::extPath('taxonomy') . 'Configuration/');
////			define('EF_PATH_DATA', PATH_site  . 'typo3temp/taxonomy/');
////			define('EF_PATH_PACKAGES', t3lib_extmgm::extPath('taxonomy') . 'Resources/PHP/');
////			$bootstrap = new \Erfurt\Core\Bootstrap('Development');
////			$bootstrap->run();
////			$objectManager = $bootstrap->getObjectManager();
////			
////			$parentNode = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('*', 'tx_taxonomy_domain_model_concept', 'uid = ' . (int) $parentNodeData->id);
////			
////			$currentNode = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('*', 'tx_taxonomy_domain_model_concept', 'uid = ' . (int) $concept->getUid());
////			
////			$store = $objectManager->get('Erfurt\Store\Store');
////			$graph = $store->getGraph('http://www.w3.org/2004/02/skos/core#');
////			$graph->addStatement('urn:uuid:' . $currentNode[0]['uuid'], 'skos:narrower', array('value' => 'urn:uuid:' . $parentNode[0]['uuid'], 'type' => 'iri'));
////			
////			$bootstrap->shutdown();
//		}
//
//
//		$response = Array (
//			'serializeClassName' => 't3lib_tree_pagetree_Node',
//			'id' => 'mp-0-76',
//			'type' => 'pages',
//			'editableText' => 'Default Title',
//			'text' => 'Default Title',
//			'cls' => '',
//			'prefix' => '',
//			'suffix' => '',
//			'qtip' => 'id=76<br />',
//			'expanded' => '1',
//			'expandable' => '',
//			'draggable' => '1',
//			'isTarget' => '1',
//			#'spriteIconCode' => '<span class="t3-icon t3-icon-tcarecords t3-icon-tcarecords-tx_taxonomy_domain_model_concept t3-icon-tx_taxonomy_domain_model_concept-default"><span class="t3-icon t3-icon-status t3-icon-status-overlay t3-icon-overlay-hidden t3-icon-overlay">&nbsp;</span></span>',
//			'spriteIconCode' => '<span class="t3-icon t3-icon-tcarecords t3-icon-tcarecords-tx_taxonomy_domain_model_concept t3-icon-tx_taxonomy_domain_model_concept-default">&nbsp;</span>',
//			't3TextSourceField' => 'title',
//			't3InCopyMode' => '',
//			't3InCutMode' => '',
//			't3ContextInfo' => Array(),
//			'editable' => '1',
//			'allowChildren' => '1',
//			'nodeData' => Array
//				(
//					'serializeClassName' => 't3lib_tree_pagetree_Node',
//					'id' => '76',
//					'type' => 'pages',
//					'editableText' => 'Default Title',
//					'text' => 'Default Title',
//					'cls' => '',
//					'prefix' => '',
//					'suffix' => '',
//					'qtip' => 'id=76<br />',
//					'expanded' => '1',
//					'expandable' => '',
//					'draggable' => '1',
//					'isTarget' => '1',
//					'spriteIconCode' => '<span class="t3-icon t3-icon-tcarecords t3-icon-tcarecords-tx_taxonomy_domain_model_concept t3-icon-tx_taxonomy_domain_model_concept-default">&nbsp;</span>',
//					't3TextSourceField' => 'title',
//					't3InCopyMode' => '',
//					't3InCutMode' => '',
//					't3ContextInfo' => Array(),
//					'editable' => '1',
//					'allowChildren' => '1',
//					'readableRootline' => '',
//					'mountPoint' => '0',
//					'workspaceId' => '76',
//					'isMountPoint' => '',
//				),
//			'realId' => '76',
//			'readableRootline' => '',
//);
//		return $response;
//				
//		/** @var $parentNode t3lib_tree_pagetree_Node */
//		$parentNode = t3lib_div::makeInstance('t3lib_tree_pagetree_Node', (array) $parentNodeData);
//
//		try {
//			$newPageId = t3lib_tree_pagetree_Commands::createNode($parentNode, $parentNode->getId(), $pageType);
//			$returnValue = t3lib_tree_pagetree_Commands::getNode($newPageId)->toArray();
//		} catch (Exception $exception) {
//			$returnValue = array(
//				 'success' => FALSE,
//				 'message' => $exception->getMessage(),
//			 );
//		}
//
//		return $returnValue;
//	}
//	
//
//	/**
//	 * Updates the given field with a new text value, may be used to inline update
//	 * the title field in the new page tree
//	 *
//	 * @param stdClass $nodeData
//	 * @param string $updatedLabel
//	 * @return array
//	 */
//	public function updateLabel($nodeData, $updatedLabel) {
//		if ($updatedLabel === '') {
//			return array();
//		}
//
//		/** @var $node t3lib_tree_pagetree_Node */
//		$node = t3lib_div::makeInstance('t3lib_tree_pagetree_Node', (array) $nodeData);
//
//		try {
//			t3lib_tree_pagetree_Commands::updateNodeLabel($node, $updatedLabel);
//
//			$shortendedText = t3lib_div::fixed_lgd_cs($updatedLabel, intval($GLOBALS['BE_USER']->uc['titleLen']));
//			$returnValue = array(
//				'editableText' => $updatedLabel,
//				'updatedText' => htmlspecialchars($shortendedText),
//			);
//		} catch (Exception $exception) {
//			$returnValue = array(
//				 'success' => FALSE,
//				 'message' => $exception->getMessage(),
//			 );
//		}
//
//		return $returnValue;
//	}
//	
//	/**
//	 * Render remote extension list
//	 *
//	 * @param object $parameters
//	 * @return string $content
//	 */
//	public function getRemoteExtensionList($parameters) {
//		return array();
//	}

//	/**
//	 * Get List of workspace changes
//	 *
//	 * @param object $parameter
//	 * @return array $data
//	 */
//	public function getWorkspaceInfos($parameter) {
//			// To avoid too much work we use -1 to indicate that every page is relevant
//		$pageId = $parameter->id > 0 ? $parameter->id : -1;
//
//		$wslibObj = t3lib_div::makeInstance('Tx_Taxonomy_Service_Workspaces');
//		$versions = $wslibObj->selectVersionsInWorkspace($this->getCurrentWorkspace(), 0, -99, $pageId, $parameter->depth);
//
//		$workspacesService = t3lib_div::makeInstance('Tx_Taxonomy_Service_GridData');
//		$data = $workspacesService->generateGridListFromVersions($versions, $parameter, $this->getCurrentWorkspace());
//		return $data;
//	}
//
//	/**
//	 * Get List of available workspace actions
//	 *
//	 * @param object $parameter
//	 * @return array $data
//	 */
//	public function getStageActions($parameter) {
//		$currentWorkspace = $this->getCurrentWorkspace();
//		$stages = array();
//		if ($currentWorkspace != Tx_Taxonomy_Service_Workspaces::SELECT_ALL_WORKSPACES) {
//			$stagesService = t3lib_div::makeInstance('Tx_Taxonomy_Service_Stages');
//			$stages = $stagesService->getStagesForWSUser();
//		}
//
//		$data = array(
//			'total' => count($stages),
//			'data' => $stages
//		);
//		return $data;
//	}
//
//	/**
//	 * Fetch futher information to current selected worspace record.
//	 *
//	 * @param object $parameter
//	 * @return array $data
//	 */
//	public function getRowDetails($parameter) {
//		global $TCA,$BE_USER;
//		$diffReturnArray = array();
//		$liveReturnArray = array();
//
//		$t3lib_diff = t3lib_div::makeInstance('t3lib_diff');
//		$stagesService = t3lib_div::makeInstance('Tx_Taxonomy_Service_Stages');
//
//		$liveRecord = t3lib_BEfunc::getRecord($parameter->table, $parameter->t3ver_oid);
//		$versionRecord = t3lib_BEfunc::getRecord($parameter->table, $parameter->uid);
//		$icon_Live = t3lib_iconWorks::mapRecordTypeToSpriteIconClass($parameter->table, $liveRecord);
//		$icon_Workspace = t3lib_iconWorks::mapRecordTypeToSpriteIconClass($parameter->table, $versionRecord);
//		$stagePosition = $stagesService->getPositionOfCurrentStage($parameter->stage);
//
//		$fieldsOfRecords = array_keys($liveRecord);
//
//		// get field list from TCA configuration, if available
//		if ($TCA[$parameter->table]) {
//			if ($TCA[$parameter->table]['interface']['showRecordFieldList']) {
//				$fieldsOfRecords = $TCA[$parameter->table]['interface']['showRecordFieldList'];
//				$fieldsOfRecords = t3lib_div::trimExplode(',',$fieldsOfRecords,1);
//			}
//		}
//
//		foreach ($fieldsOfRecords as $fieldName) {
//				// check for exclude fields
//			if ($GLOBALS['BE_USER']->isAdmin() || ($TCA[$parameter->table]['columns'][$fieldName]['exclude'] == 0) || t3lib_div::inList($BE_USER->groupData['non_exclude_fields'],$parameter->table.':'.$fieldName)) {
//					// call diff class only if there is a difference
//				if (strcmp($liveRecord[$fieldName],$versionRecord[$fieldName]) !== 0) {
//						// Select the human readable values before diff
//					$liveRecord[$fieldName] = t3lib_BEfunc::getProcessedValue($parameter->table,$fieldName,$liveRecord[$fieldName],0,1);
//					$versionRecord[$fieldName] = t3lib_BEfunc::getProcessedValue($parameter->table,$fieldName,$versionRecord[$fieldName],0,1);
//
//					$fieldTitle = $GLOBALS['LANG']->sL(t3lib_BEfunc::getItemLabel($parameter->table, $fieldName));
//
//					if ($TCA[$parameter->table]['columns'][$fieldName]['config']['type'] == 'group' && $TCA[$parameter->table]['columns'][$fieldName]['config']['internal_type'] == 'file') {
//						$versionThumb = t3lib_BEfunc::thumbCode($versionRecord, $parameter->table, $fieldName, '');
//						$liveThumb = t3lib_BEfunc::thumbCode($liveRecord, $parameter->table, $fieldName, '');
//
//						$diffReturnArray[] = array(
//							'label' => $fieldTitle,
//							'content' => $versionThumb
//						);
//						$liveReturnArray[] = array(
//							'label' => $fieldTitle,
//							'content' => $liveThumb
//						);
//					} else {
//						$diffReturnArray[] = array(
//							'label' => $fieldTitle,
//							'content' => $t3lib_diff->makeDiffDisplay($liveRecord[$fieldName], $versionRecord[$fieldName]) // call diff class to get diff
//						);
//						$liveReturnArray[] = array(
//							'label' => $fieldTitle,
//							'content' => $liveRecord[$fieldName]
//						);
//					}
//				}
//			}
//		}
//
//		$commentsForRecord = $this->getCommentsForRecord($parameter->uid, $parameter->table);
//
//		return array(
//			'total' => 1,
//			'data' => array(
//				array(
//					'diff' => $diffReturnArray,
//					'live_record' => $liveReturnArray,
//					'path_Live' => $parameter->path_Live,
//					'label_Stage' => $parameter->label_Stage,
//					'stage_position' => $stagePosition['position'],
//					'stage_count' => $stagePosition['count'],
//					'comments' => $commentsForRecord,
//					'icon_Live' => $icon_Live,
//					'icon_Workspace' => $icon_Workspace
//				)
//			)
//		);
//	}
//
//	/**
//	 * Gets an array with all sys_log entries and their comments for the given record uid and table
//	 *
//	 * @param integer $uid uid of changed element to search for in log
//	 * @return string $table table name
//	 */
//	public function getCommentsForRecord($uid, $table) {
//		$stagesService = t3lib_div::makeInstance('Tx_Taxonomy_Service_Stages');
//		$sysLogReturnArray = array();
//
//		$sysLogRows = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
//				'log_data,tstamp,userid',
//				'sys_log',
//				'action=6 and details_nr=30
//				AND tablename='.$GLOBALS['TYPO3_DB']->fullQuoteStr($table,'sys_log').'
//				AND recuid='.intval($uid),
//				'',
//				'tstamp DESC'
//		);
//
//		foreach($sysLogRows as $sysLogRow)	{
//			$sysLogEntry = array();
//			$data = unserialize($sysLogRow['log_data']);
//			$beUserRecord = t3lib_BEfunc::getRecord('be_users', $sysLogRow['userid']);
//
//			$sysLogEntry['stage_title'] = $stagesService->getStageTitle($data['stage']);
//			$sysLogEntry['user_uid'] = $sysLogRow['userid'];
//			$sysLogEntry['user_username'] = is_array($beUserRecord) ? $beUserRecord['username'] : '';
//			$sysLogEntry['tstamp'] = t3lib_BEfunc::datetime($sysLogRow['tstamp']);
//			$sysLogEntry['user_comment'] = $data['comment'];
//
//			$sysLogReturnArray[] = $sysLogEntry;
//		}
//
//		return $sysLogReturnArray;
//	}
}

?>
