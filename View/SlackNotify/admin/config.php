<?php echo $this->BcForm->create('SlackNotifyConfig') ?>

<section class="bca-section">
	<h2>Slack設定</h2>
	<table class="form-table bca-form-table">
		<tr>
			<th class="col-head bca-form-table__label">
				<?php echo $this->BcForm->label('SlackNotifyConfig.bot_user_oauth_token', 'Bot User OAuth Token') ?>
			</th>
			<td class="col-input bca-form-table__input">
				<?php echo $this->BcForm->input('SlackNotifyConfig.bot_user_oauth_token', ['type' => 'text', 'size' => 80, 'maxlength' => 255, 'autofocus' => true]) ?><br>
				<span style="font-size: 1.2rem; color: #888;">「<a href="https://api.slack.com/apps" target="_blank">Slack API: Applications</a>」からBot User OAuth Tokenを確認してください。</span>
				<?php echo $this->BcForm->error('SlackNotifyConfig.bot_user_oauth_token') ?>
			</td>
		</tr>
	</table>

	<h2>メールフォーム設定</h2>
	<table class="form-table bca-form-table">
		<?php if (!empty($mailContents)) : ?>
			<?php foreach ($mailContents as $mailContent) : ?>
				<tr>
					<th class="col-head bca-form-table__label">
						<?php echo $this->BcForm->label('SlackNotifyMessage.' . $mailContent['MailContent']['id'] . '.message', $mailContent['Content']['title'] . ' (' . urldecode($mailContent['Content']['name']) . ')', ['style' => 'word-break: break-all;']) ?>
					</th>
					<td class="col-input bca-form-table__input">
						<?php echo $this->BcForm->input('SlackNotifyMessage.' . $mailContent['MailContent']['id'] . '.id', ['type' => 'hidden', 'value' => $mailContent['MailContent']['id']]) ?>
						<?php echo $this->BcForm->input('SlackNotifyMessage.' . $mailContent['MailContent']['id'] . '.mail_content_id', ['type' => 'hidden', 'value' => $mailContent['MailContent']['id']]) ?>
						<p>
							<?php echo $this->BcForm->input('SlackNotifyMessage.' . $mailContent['MailContent']['id'] . '.status', ['type' => 'checkbox', 'label' => '有効にする', 'autofocus' => true]) ?>
							<?php echo $this->BcForm->error('SlackNotifyMessage.' . $mailContent['MailContent']['id'] . '.status') ?>
						</p>
						<p>
							<?php echo $this->BcForm->label('SlackNotifyMessage.' . $mailContent['MailContent']['id'] . '.channel', 'チェンネル') ?><br>
							<?php echo $this->BcForm->input('SlackNotifyMessage.' . $mailContent['MailContent']['id'] . '.channel', ['type' => 'text', 'size' => 40, 'maxlength' => 255, 'autofocus' => true]) ?><br>
							<span style="font-size: 1.2rem; color: #888;">「#」の入力は不要です。</span>
							<?php echo $this->BcForm->error('SlackNotifyMessage.' . $mailContent['MailContent']['id'] . '.channel') ?>
						</p>
						<p>
							<?php echo $this->BcForm->label('SlackNotifyMessage.' . $mailContent['MailContent']['id'] . '.message', 'メッセージ') ?><br>
							<?php echo $this->BcForm->input('SlackNotifyMessage.' . $mailContent['MailContent']['id'] . '.message', ['type' => 'textarea', 'autofocus' => true]) ?><br>
							<span style="font-size: 1.2rem; color: #888;">
								送信データの表示は {{フィールド名}} の形式で記述してください。<br>
								メンションは以下のように設定できます。<br>
								@channel: &lt;!channel&gt;, @here: &lt;!here&gt;, @everyone: &lt;!everyone&gt;, @user: &lt;@user_id&gt;<br>
								※ user_idはSlackアプリからプロフィールを開き「メンバーIDをコピー」をクリックすることで取得できます。
							</span>
							<?php echo $this->BcForm->error('SlackNotifyMessage.' . $mailContent['MailContent']['id'] . '.message') ?>
						</p>
					</td>
				</tr>
			<?php endforeach ?>
		<?php else : ?>
			<p>メールフォームがありません。</p>
		<?php endif ?>
	</table>
</section>

<section class="bca-actions">
	<div class="bca-actions__main">
		<?php echo $this->BcForm->button(__d('baser', '保存'), [
			'type' => 'submit',
			'id' => 'BtnSave',
			'div' => false,
			'class' => 'button bca-btn bca-actions__item',
			'data-bca-btn-type' => 'save',
			'data-bca-btn-size' => 'lg',
			'data-bca-btn-width' => 'lg',
		]) ?>
	</div>
</section>

<?php echo $this->BcForm->end() ?>
