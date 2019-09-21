<div class="padding-left margin-top-2 border-bottom-2 border-mute-light fore-color-1"><?php echo l10n('admin_test_email', 'Email form test'); ?></div>
<script>
function onMethodChange() {
	var attachment = $( '#attachment, [for=attachment]' ),
		val = $( "#type" ).val();

	// SMTP fields
	if ( val == 'phpmailer-smtp' ) {
		$( '.smtp' ).css( "display", "block" );
		$( '.smtp-auth' ).css( "display", $("#smtpauth").prop("checked") ? "table-row" : "none" );
	} else {
		$( '.smtp, .smtp-auth' ).css( "display", "none" );
	}

	// Hide the attachment field
	if ( val == 'text' ) {
		attachment.val('').css( "display", "none" );
	} else {
		attachment.css( "display", "block" );
	}
}
function downloadScript() {
	document.location.href = "download.php?what=" + $(this).val();
}
$( document ).ready(function () {
<?php if (strlen(@$_SESSION["form_test_type"])): ?>
	$( "#type" ).val( '<?php echo htmlentities(@$_SESSION["form_test_type"]) ?>' );
<?php endif; ?>
<?php if (strlen(@$_SESSION["form_test_smtpencryption"])): ?>
	$( "#smtpencryption" ).val( '<?php echo htmlentities(@$_SESSION["form_test_smtpencryption"]) ?>' );
<?php endif; ?>
<?php if (strlen(@$_SESSION["form_test_smtpauth"])): ?>
	$( "#smtpauth" ).prop( "checked", true );
<?php endif; ?>
	onMethodChange();
});
</script>
<form action="sitetest.php" method="post" enctype="multipart/form-data" onreset="setTimeout(onMethodChange)">
	<table class="email-test div-phone" style="width: auto;">
		<tbody class="div-phone">
			<tr class="div-phone">
				<td class="small text-middle div-phone">
					<label for="type" class="div-phone"><?php echo l10n('form_script_type'); ?></label>
				</td>
				<td class="div-phone">
					<!-- enable disable the attachment field basing on the email type -->
					<select class="border border-mute-light background-transparent" name="type" id="type" onchange="onMethodChange.apply(this)">
						<option value="phpmailer"><?php echo l10n('form_script_type_phpmailer', 'PHP Mailer'); ?></option>
						<option value="phpmailer-smtp"><?php echo l10n('form_script_type_phpmailer_smtp', 'PHP Mailer (SMTP)'); ?></option>
						<option value="html"><?php echo l10n('form_script_type_html'); ?></option>
						<option value="html-x"><?php echo l10n('form_script_type_html_x'); ?></option>
						<option value="text"><?php echo l10n('form_script_type_text'); ?></option>
					</select>
					<a class="no-phone fore-color-1 text-underline" href="#" onclick="downloadScript.apply(document.getElementById('type'))"><?php echo l10n("admin_download", "Download") ?></a>
				</td>
			</tr>
		</tbody>
	</table>
	<fieldset class="smtp">
		<legend>SMTP</legend>
		<table class="email-test div-phone" style="width: auto;">
			<tbody class="div-phone">
				<tr class="div-phone">
					<td class="div-phone small" colspan="2">
						<input class="border border-mute-light background-transparent" type="text" placeholder="<?php echo trim(l10n('form_smtphost', "Host"), ":"); ?>" name="smtphost" id="smtphost" value="<?php echo htmlentities(@$_SESSION['form_test_smtphost']) ?>"/>
					</td>
				</tr>
				<tr class="div-phone" colspan="2">
					<td class="small div-phone">
						<input class="border border-mute-light background-transparent" type="text" placeholder="<?php echo trim(l10n('form_smtpport', "Port"), ":"); ?>" name="smtpport" id="smtpport" value="<?php echo htmlentities(@$_SESSION['form_test_smtpport']) ?>"/>
					</td>
				</tr>
				<tr class="div-phone">
					<td class="small div-phone">
						<label for="smtpencryption"><?php echo l10n('form_smtpencryption', "Encryption type:"); ?></label>
					</td>
					<td class="small div-phone">
						<select class="border border-mute-light background-transparent" name="smtpencryption" id="smtpencryption">
							<option value="none">None</option>
							<option value="ssl">SSL</option>
							<option value="tls">TLS</option>
						</select>
					</td>
				</tr>
				<tr class="div-phone">
					<td class="small div-phone" colspan="2">
						<input type="checkbox" name="smtpauth" id="smtpauth" onchange="onMethodChange.apply(this)" value="1" <?php if (@$_SESSION['form_test_smtpauth']=='1') "checked" ?>/>
						<label class="border border-mute-light background-transparent" for="smtpauth"><?php echo l10n('form_smtpauth', "Use Authentication"); ?></label>
					</td>
				</tr>
				<tr class="smtp-auth div-phone">
					<td class="small div-phone" colspan="2">
						<input class="border border-mute-light background-transparent" type="text" placeholder="<?php echo trim(l10n('form_smtpusername', "Username"), ":"); ?>" name="smtpusername" id="smtpusername" value="<?php echo htmlentities(@$_SESSION['form_test_smtpusername']) ?>"/>
					</td>
				</tr>
				<tr class="smtp-auth div-phone">
					<td class="small div-phone" colspan="2">
						<input class="border border-mute-light background-transparent" type="password" placeholder="<?php echo trim(l10n('form_smtppassword', "Password"), ":"); ?>" name="smtppassword" id="smtppassword"/>
					</td>
				</tr>
			</tbody>
		</table>
	</fieldset>
	<table class="email-test div-phone">
		<tbody class="div-phone">
			<tr class="div-phone">
				<td class="small div-phone" colspan="2">
					<input class="border border-mute-light background-transparent" placeholder="<?php echo trim(l10n('form_from'), ":"); ?>" type="text" name="from" id="from" value="<?php echo htmlentities(@$_SESSION['form_test_from']) ?>"/>
				</td>
			</tr>
			<tr class="div-phone">
				<td class="small div-phone" colspan="2">
					<input class="border border-mute-light background-transparent" type="text" id="to" placeholder="<?php echo trim(l10n('form_to'), ":"); ?>" name="to" value="<?php echo htmlentities(@$_SESSION['form_test_to']) ?>"/>
				</td>
			</tr>
			<tr class="div-phone">
				<td class="small div-phone" colspan="2">
					<input class="border border-mute-light background-transparent" type="text" placeholder="<?php echo trim(l10n('form_subject'), ":"); ?>" class="email-subject" name="subject" value="<?php echo htmlentities(@$_SESSION['form_test_subject']) ?>"/>
				</td>
			</tr>
			<tr class="div-phone">
				<td class="small div-phone" colspan="2">
					<textarea class="border border-mute-light background-transparent" name="body" id="body" style="width: 99%;" rows="10"><?php echo htmlentities(@$_SESSION['form_test_body']) ?></textarea>	
				</td>
			</tr>
			<tr class="div-phone">
				<td class="small div-phone">
					<label for="attachment"><?php echo trim(l10n('form_attachment', 'Attachment'), ":"); ?></label>
				</td>
				<td class="small div-phone">
					<input type="file" name="attachment" id="attachment"/>
				</td>
			</tr>
		</tbody>
	</table>
	<div class="text-center margin-top-2">
		<input type="submit" class="button background-color-1 fore-white" value="<?php echo l10n('form_submit'); ?>" name="send">
		<input type="reset" class="button background-color-1 fore-white" value="<?php echo l10n('form_reset'); ?>">	
	</div>				
</form>
<?php if (!Configuration::getControlPanel()->isWsx5Manager()): ?>
<script>$(document).ready(function () { $("#from").focus(); });</script>
<?php endif; ?>
<?php 
