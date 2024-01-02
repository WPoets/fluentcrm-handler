<?php
namespace aw2\fluentcrm;

\aw2_library::add_service('fluentcrm','FLuentCRM Library.',['namespace'=>__NAMESPACE__]);

\aw2_library::add_service('fluentcrm.contact.add','Run WooCommerce actions',['func'=>'contact_add','namespace'=>__NAMESPACE__]);

function contact_add($atts, $content = null, $shortcode=null){
    if(\aw2_library::is_live_debug()){
		
		$live_debug_event=array();
		$live_debug_event['flow']='fluentcrm';
		$live_debug_event['action']='fluentcrm.contact.add';
		$live_debug_event['stream']='fluentcrm.contact';

	}

    if(is_fluentcrm_active()===false){
        if(\aw2_library::is_live_debug()){
			
			$temp_debug=$live_debug_event;
			$temp_debug['error']='yes';
			$temp_debug['error_message']='FluentCRM plugin is not active';
			$temp_debug['error_type']='plugin_error';
			\aw2\live_debug\publish_event(['event'=>$temp_debug,'bgcolor'=>'#FFC3C3']);
		}
        throw new \Exception('FluentCRM is not active.');
    }
        

    $data = json_decode($content,true);
    if(empty($data)){
        if(\aw2_library::is_live_debug()){
			
			$temp_debug=$live_debug_event;
			$temp_debug['error']='yes';
			$temp_debug['error_message']='JSON decode failed.';
            $temp_debug['content']=$content;
			$temp_debug['error_type']='json_fail';
			\aw2\live_debug\publish_event(['event'=>$temp_debug,'bgcolor'=>'#FFC3C3']);
		}
        throw new \Exception('Issue with JSON data.');
    }

    $contactApi = FluentCrmApi('contacts');
    $contact = $contactApi->createOrUpdate($data);

    // send a double opt-in email if the status is pending
    if($contact && $contact->status == 'pending') {
        $contact->sendDoubleOptinEmail();
    }

    if(\aw2_library::is_live_debug()){
			
        $temp_debug=$live_debug_event;
        $temp_debug['content']=$content;
        $temp_debug['message']='Contact added to FluentCRM';
        \aw2\live_debug\publish_event(['event'=>$temp_debug,'bgcolor'=>'#FFC3C3']);
    }
 }

 function is_fluentcrm_active(){
    $status= function_exists('FluentCrmApi')?true:false;
    return $status;
 }