<?php echo $this->Form->create('Submission', array('type' => 'file'));?>
    <fieldset>
        <legend><?php __('Mark Submission'); ?></legend>
    <h3>User</h3>
    <?php
        echo $this->data['User']['forename']. ' '.$this->data['User']['surname'].' - ';
        echo $this->data['Group']['code'];?>
        <h3>File uploaded</h3>
        <div id='attachment'>
        <span id='attachment_icon'>
        <?php echo $html->image($icon, array('alt' => $this->data['Submission']['type'])); ?>
        </span>
        <p><?php echo $this->data['Submission']['filename']; ?><br />
        <?php echo $number->toReadableSize($this->data['Submission']['size']); ?></p><br />
        <span class="actions">
        <?php echo $this->Html->link(__('Download file', true), 
                    array('controller' => 'submissions', 'action' => 'download', $this->data['Submission']['id'])); ?>
        </span>
        </div>
<!--        <p><a href='javascript:;' onclick='javascript:$("#preview_file").toggle();'><?php __('Show/hide file preview')?></a></p>
        <div id='preview_file' style='display:none'>
        <iframe src="http://viewer.zoho.com/api/urlview.do?url=<?php echo urlencode($_SERVER['SERVER_NAME'] .
                $this->Html->url(array('controller' => 'submissions', 
                                       'action' => 'download', 
                                       $this->data['Submission']['id']
                                      )
                                )
                ).'/'.sha1($this->data['Submission']['filename']) ?>"
            width="600" height="780" style="border: none;"></iframe>
        </div>-->
        <?php
        echo $form->hidden('id');
        echo $form->input('mark_id', array('options' => $all_marks));
        echo $form->input('status_id', array('options' => $all_statuses));
        echo $form->input('comment');?>
        <?php echo $form->input('Upload', array('type' => 'file', 'label' => __('Marked File', true)));?>
        <?php if (!empty($this->data['Submission']['response_filename'])): ?>
        <span class='small_label'>
        <?php echo $form->input('remove_response', array('label' => 'Remove Marked File', 'type' => 'checkbox')); ?>
        </span>
        <div id='attachment'>
        <span id='attachment_icon'>
        <?php echo $html->image($response_icon, array('alt' => $this->data['Submission']['response_type'])); ?>
        </span>
        <p><?php echo $this->data['Submission']['response_filename']; ?><br />
        <?php echo $number->toReadableSize($this->data['Submission']['response_size']); ?></p><br />
        <span class='actions'>
        <?php echo $this->Html->link(__('Download File', true), array('controller' => 'submissions', 'action' => 'download_response', $this->data['Submission']['id'])); ?>
        </span>

        </div>
        <?php endif; ?>
        <?php /*        echo $this->Html->para('tip', __('Here you can repond with a marked file.')); */?>
    </fieldset>
<?php echo $this->Form->end(__('Submit', true));?>