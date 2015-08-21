Ext.define('SIS.view.toolbar.Pagenate', {
    extend: 'Ext.PagingToolbar',
    alias: 'widget.pagenate',

    flex: 1,
    dock: 'bottom',
    displayInfo: true,  
    displayMsg: '显示 {0} - {1} 共计 {2}',  
    emptyMsg: '没有记录'
});