<?php

class qa_webhooks
{

	// Admin page form
	public function admin_form(&$qa_content)
	{

		if (qa_clicked('q2a_webhooks_save_button')) {
			qa_opt('q2a_webhooks_dest_ip', qa_post_text('q2a_webhooks_dest_ip_field'));
		}

		$dest_ip = qa_opt('q2a_webhooks_dest_ip');

		qa_set_display_rules($qa_content, array(
			'event_logger_directory_display' => 'event_logger_to_files_field',
			'event_logger_hide_header_display' => 'event_logger_to_files_field',
		));

		return array(

			'fields' => array(
				array(
					'label' => 'Webhook to send events to',
					'tags' => 'name=q2a_webhooks_dest_ip_field',
					'value' => qa_opt('q2a_webhooks_dest_ip'),
					'type' => qa_html($dest_ip),
				),
			),

			'buttons' => array(
				array(
					'label' => 'Save Changes',
					'tags' => 'name="q2a_webhooks_save_button"',
				),
			),
		);
	}


	// Function to handle each event triggered
	public function process_event($event, $userid, $handle, $cookieid, $params)
	{
		$data = array(
			'event' => $event,
			'userid' => $userid,
			'handle' => $handle,
			'cookieid' => $cookieid,
			'params' => $params,
		);
		$data_string = http_build_query($data);
		
		$dest_ip = qa_opt('q2a_webhooks_dest_ip');
		$ch = curl_init($dest_ip);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		curl_exec($ch);
		curl_close($ch);  
	
	}
}
