批量添加班级
<?php
echo $this->Form->create('Department');
	echo $this->Form->input('start');
	echo $this->Form->input('end');
	echo $this->Form->input('parent_id');
	echo $this->Form->end(__('Submit')); ?>