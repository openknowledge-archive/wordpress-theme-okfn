<?php global $options;
  foreach ($options as $value) {
    if(array_key_exists('id', $value)) {
      if (get_option( $value['id'] ) === FALSE) {
        if (array_key_exists('std', $value)) {
          $$value['id'] = $value['std'] or NULL;
        }
      } else {
        $$value['id'] = get_option( $value['id'] );
      }
    }
  }
if ( $okfn_mailchimp_bar == "true" or $okfn_mailinglist_bar == "true" or $okfn_mailinglist_bar2 == "true") : ?>
	<?php $mailinglist_counter = 0;
  $mailtab_id = 0;
  $mail_id = 0;
  ?>
  <div class="tabbable mailing-lists">
    <div class="container">
      <ul class="nav nav-tabs">
        <?php if ( $okfn_mailchimp_bar == "true") : ?><li class="mailtab<?php echo ++$mailtab_id ?>"><a href="#tab<?php echo $mailtab_id ?>" data-toggle="tab"><?php if (!empty($okfn_mailchimp_heading)) { echo $okfn_mailchimp_heading;} else { echo 'Mailing List '.$mailtab_id ;} ?></a></li><?php endif; ?>
        <?php if ( $okfn_mailinglist_bar == "true") : ?><li class="mailtab<?php echo ++$mailtab_id ?>"><a href="#tab<?php echo $mailtab_id ?>" data-toggle="tab"><?php if (!empty($okfn_mailinglist_heading)) { echo $okfn_mailinglist_heading;} else { echo 'Mailing List '.$mailtab_id;} ?></a></li><?php endif; ?>
        <?php if ( $okfn_mailinglist_bar2 == "true") : ?><li class="mailtab<?php echo ++$mailtab_id ?>"><a href="#tab<?php echo $mailtab_id ?>" data-toggle="tab"><?php if (!empty($okfn_mailinglist_heading2)) { echo $okfn_mailinglist_heading2;} else { echo 'Mailing List '.$mailtab_id;} ?></a></li><?php endif; ?>
      </ul>
    </div>
    <section class="subscribe">
      <div class="tab-content container">
      <?php // list 1
      if ( $okfn_mailchimp_bar == "true") {
         $mailinglist_counter += 1;
          if (!empty( $okfn_mailchimp_id )) {
            $mcid = $okfn_mailchimp_id;
          }
          else {
            $mcid = '1';
          }
          ?>
            <div class="tab-pane mailchimp-plugin" id="tab<?php echo ++$mail_id ?>">
            <div>
           <?php if (!empty($okfn_mailchimp_heading)) { echo '<span class="heading">' . $okfn_mailchimp_heading .' </span>';} if (!empty($okfn_mailchimp_description)) { echo '<span class="description">'. $okfn_mailchimp_description .'</span>';}
							echo do_shortcode('[nm-mc-form fid="'.$mcid.'"]');
          ?>
            </div>
            </div>
          <?php }

      // list 2
      if ( $okfn_mailinglist_bar == "true") {
         $mailinglist_counter += 1;
				 if ($okfn_mailinglist_bar_type == "mailchimp") {
           ?>
            <div class="tab-pane" id="tab<?php echo ++$mail_id ?>">
               <!-- Begin MailChimp Signup Form -->
                <div id="mc_embed_signup">
                  <form action="<?php echo $okfn_mailinglist_action?>" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                    <table width="100%">
                      <tr>
                        <th scope="row"><?php if (!empty($okfn_mailinglist_heading)) { echo '<span class="heading">' . $okfn_mailinglist_heading .' </span>';} if (!empty($okfn_mailinglist_description)) { echo '<span class="description">'. $okfn_mailinglist_description .'</span>';} ?></th>
                        <td><label for="mce-EMAIL">Email Address </label>
                            <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="Email Address"></td>
                        <td><label for="mce-FNAME">First Name </label>
                            <input type="text" value="" name="FNAME" class="" id="mce-FNAME" placeholder="First Name"></td>
                        <td><label for="mce-LNAME">Last Name </label>
                            <input type="text" value="" name="LNAME" class="" id="mce-LNAME" placeholder="Last Name"></td>
                        <td class="submit"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></td>
                      </tr>
                    </table>
                    <div id="mce-responses" class="clear">
                      <div class="response" id="mce-error-response" style="display:none"></div>
                      <div class="response" id="mce-success-response" style="display:none"></div>
                    </div>
                  </form>
                </div>
                <!--End mc_embed_signup-->
            </div>
           <?php }
				 elseif ($okfn_mailinglist_bar_type == "mailman") {
					 ?>
            <div class="tab-pane" id="tab<?php echo ++$mail_id ?>">
             <form method="post" action="<?php echo $okfn_mailinglist_action?>">
                  <table width="100%">
                    <tr>
                      <th scope="row"><?php if (!empty($okfn_mailinglist_heading)) { echo '<span class="heading">' . $okfn_mailinglist_heading .' </span>';} if (!empty($okfn_mailinglist_description)) { echo '<span class="description">'. $okfn_mailinglist_description .'</span>';} ?></th>
                      <td>
                        <label><?php echo __("Name", "okfn")?></label>
                        <input name="fullname" placeholder="<?php echo __("Name", "okfn")?>" type="text">
                      </td>
                      <td>
                        <label><?php echo __("Email Address", "okfn")?></label>
                        <input name="email" placeholder="<?php echo __("Email Address", "okfn")?>" type="email">
                      </td>
                      <td class="announce">
                        <label class="checkbox">
                          <input type="checkbox" value="" disabled>
                          <?php echo __("Receive newsletter", "okfn")?>
                        </label>
                      </td>
                      <td class="submit">
                        <input type="submit" name="email-button" value="<?php echo __("Subscribe", "okfn")?>" class="button">
                      </td>
                    </tr>
                  </table>
                </form>
            </div>
           <?php }
      }

      // list 3
      if ( $okfn_mailinglist_bar2 == "true") {
         $mailinglist_counter += 1;
         if ($okfn_mailinglist_bar_type2 == "mailchimp") {
           ?>
            <div class="tab-pane" id="tab<?php echo ++$mail_id ?>">
             <!-- Begin MailChimp Signup Form -->
                <div id="mc_embed_signup">
                  <form action="<?php echo $okfn_mailinglist_action2?>" method="post" id="mc-embedded-subscribe-form2" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                    <table width="100%">
                      <tr>
                        <th scope="row"><?php if (!empty($okfn_mailinglist_heading2)) { echo '<span class="heading">' . $okfn_mailinglist_heading2 .' </span>';} if (!empty($okfn_mailinglist_description2)) { echo '<span class="description">'. $okfn_mailinglist_description2 .'</span>';} ?></th>
                        <td><label for="mce-EMAIL">Email Address </label>
                            <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="Email Address"></td>
                        <td><label for="mce-FNAME">First Name </label>
                            <input type="text" value="" name="FNAME" class="" id="mce-FNAME" placeholder="First Name"></td>
                        <td><label for="mce-LNAME">Last Name </label>
                            <input type="text" value="" name="LNAME" class="" id="mce-LNAME" placeholder="Last Name"></td>
                        <td class="submit"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></td>
                      </tr>
                    </table>
                    <div id="mce-responses" class="clear">
                      <div class="response" id="mce-error-response" style="display:none"></div>
                      <div class="response" id="mce-success-response" style="display:none"></div>
                    </div>
                  </form>
                </div>
                <!--End mc_embed_signup-->
            </div>
           <?php }
				 elseif ($okfn_mailinglist_bar_type2 == "mailman") {
					 ?>
            <div class="tab-pane" id="tab<?php echo ++$mail_id ?>">
             <form method="post" action="<?php echo $okfn_mailinglist_action?>">
                  <table width="100%">
                    <tr>
                      <th scope="row"><?php if (!empty($okfn_mailinglist_heading2)) { echo '<span class="heading">' . $okfn_mailinglist_heading2 .' </span>';} if (!empty($okfn_mailinglist_description2)) { echo '<span class="description">'. $okfn_mailinglist_description2 .'</span>';} ?></th>
                      <td>
                        <label><?php echo __("Name", "okfn")?></label>
                        <input name="fullname" placeholder="<?php echo __("Name", "okfn")?>" type="text">
                      </td>
                      <td>
                        <label><?php echo __("Email Address", "okfn")?></label>
                        <input name="email" placeholder="<?php echo __("Email Address", "okfn")?>" type="email">
                      </td>
                      <td class="announce">
                        <label class="checkbox">
                          <input type="checkbox" value="" disabled>
                          <?php echo __("Receive newsletter", "okfn")?>
                        </label>
                      </td>
                      <td class="submit">
                        <input type="submit" name="email-button" value="<?php echo __("Subscribe", "okfn")?>" class="button">
                      </td>
                    </tr>
                  </table>
                </form>
            </div>
           <?php }
      }
      ?>
      </div>
    </section>
  </div>
  <script>
	  $("ul.nav.nav-tabs li.mailtab1").addClass("active");
		$("div.tab-content #tab1").addClass("active");
    <?php if ($mailinglist_counter == '1' or $okfn_mailinglist_bar_location == "header") : ?>
    $("div.mailing-lists").removeClass("tabbable");
	  <?php endif; ?>
		<?php if ( $okfn_mailchimp_bar == "true") : ?>
		// label over input
		$("section.subscribe div.mailchimp-plugin").addClass("label-over");
		$('div.label-over input').each(function() {
			var elem = $(this);
			$('label[for="' + $(this).attr('id') + '"]').click(function() {
				elem.focus();
			});
			if ($(this).val() != '') {
				$('label[for="' + $(this).attr('id') + '"]').hide();
			}
		}).focus(function() {
			$('label[for="' + $(this)[0].id + '"]').hide();
		}).blur(function() {
			if($(this).val() == '') {
				$('label[for="' + $(this)[0].id + '"]').show();
			}
		}).change(function(){
			if($(this).val() != '') {
				$('label[for="' + $(this)[0].id + '"]').hide();
			}
		})
    <?php endif; ?>
  </script>

<?php endif; ?>

