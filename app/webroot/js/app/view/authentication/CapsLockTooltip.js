Ext.define('SIS.view.authentication.CapsLockTooltip',{
	extend:'Ext.tip.QuickTip',
	alias: 'widget.capslocktooltip',
	target:'password',
	anthor:'top',
	anchorOffset:60,
	width:300,
	dissmisDelay:0,
	autoHide:false,
	title:'<div class="capslock">Caps Lock is On</div>',
	html:'大小写锁定已经打开，这可能会导致您输入错误的密码'
})