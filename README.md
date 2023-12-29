<p align="center">
<a href="https://www.wpoets.com/" target="_blank"><img width="200"src="https://www.wpoets.com/wp-content/uploads/2018/05/WPoets-logo-1.svg"></a>
</p>

# FluentCRM handler

Integrates FluentCRM with Awesome Enterprise. Introduces fluentcrm.contact.* shortcodes.

It can be installed using following composer command

`composer require wpoets/fluentcrm-handler`

### Changelog  

##### 1.0.0  
* Initial release with ability to add/update contacts.

Here the shortcode that you use once this handler is enabled.
`[fluentcrm.contact.add]
{
		"first_name" : "Jhon",
    "last_name" : "Doe",
    "email" : "amit@wpoets.com", 
    "status" : "pending",
    "tags" : [ 1,4 ],
    "lists" : [1] ,
    "custom_values" :{
        "custom_field_slug_1" : "custom_field_value_1",
        "custom_field_slug_2" : "custom_field_value_2"
    }
}
[/fluentcrm.contact.add]`


## We're Hiring!

<p align="center">
<a href="https://www.wpoets.com/careers/"><img src="https://www.wpoets.com/wp-content/uploads/2020/11/work-with-us_1776x312.png" alt="Join us at WPoets, We specialize in designing, building and maintaining complex enterprise websites and portals in WordPress."></a>
</p>
