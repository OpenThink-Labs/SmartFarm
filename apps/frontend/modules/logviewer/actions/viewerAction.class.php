<?php
/**
 * Viewer
 *
 * @package    apps.frontend.modules
 * @subpackage logviewer
 * @author     Wildan Maulana, OpenThink Labs
 *
 */
class viewerAction extends sfActions {
	public function execute($request)
	{
		$which_one   =  $request->getParameter("which_one") ;
		$callback    =  $request->getParameter("callback") ;
		$logs        =  LogTable::getAll();
		
		switch($which_one) {
			case "Tair(C)-c.json":
				$data = "{$callback}(
						[" ;
				        foreach($logs as $log) {
				        	$jstime  = $log->getJstime()*1000;
				        	$tair    = $log->getTair();
				        	$data   .= "[{$jstime},{$tair}]," ; 
				        }
				        
				$data  = rtrim($data,",");		
                $data .= "]);" ;
				
				return $this->renderText($data);
				break;
			case "RH(%)-c.json":
				$data = "{$callback}(
						[" ;
				        foreach($logs as $log) {
				        	$jstime  = $log->getJstime()*1000;
				        	$rh      = $log->getRh();
				        	$data   .= "[{$jstime},{$rh}]," ; 
				        }
				        
				$data  = rtrim($data,",");		
                $data .= "]);" ;

				return $this->renderText($data);
				break;
			case "Text(C)-c.json":
				$data = "{$callback}(
						[" ;
				        foreach($logs as $log) {
				        	$jstime  = $log->getJstime()*1000;
				        	$text    = $log->getText();
				        	$data   .= "[{$jstime},{$text}]," ; 
				        }
				        
				$data  = rtrim($data,",");		
                $data .= "]);" ;
                
				return $this->renderText($data);				
				break;
		}
	}
}