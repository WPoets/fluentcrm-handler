<?php
namespace aw2\fluentcrm;
/**
 *  [fluentcrm.contact.add /]
 *  [fluentcrn.contact.update /]
 *  [.attach]
 *  [.detach]
 */
\aw2_library::add_service('fluentcrm','FLuentCRM Library.',['namespace'=>__NAMESPACE__]);

\aw2_library::add_service('fluentcrm.contact.add','Run WooCommerce actions',['func'=>'contact_add','namespace'=>__NAMESPACE__]);

function contact_add($atts, $content = null, $shortcode=null){
    \util::var_dump($content);
    $data = json_decode($content,true);
    \util::var_dump($data);
    $contactApi = FluentCrmApi('contacts');
    $contact = $contactApi->createOrUpdate($data);

    // send a double opt-in email if the status is pending
    if($contact && $contact->status == 'pending') {
        $contact->sendDoubleOptinEmail();
    }
 }