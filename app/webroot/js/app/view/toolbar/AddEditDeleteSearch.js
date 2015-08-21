Ext.define('SIS.view.toolbar.AddEditDeleteSearch', {
    extend: 'Ext.toolbar.Toolbar',
    alias: 'widget.addeditdeletesearch',

    flex: 1,
    dock: 'top',
    items: [
        {
            xtype: 'button',
            text: '添加',
            itemId: 'add',
            iconCls: 'add'
        },
        {
            xtype: 'button',
            text: '编辑',
            itemId: 'edit',
            iconCls: 'edit'
        },
        {
            xtype: 'button',
            text: '删除',
            itemId: 'delete',
            iconCls: 'delete'
        },
        {
            xtype: 'tbseparator'
        },
        /*{
            xtype: 'button',
            text: '打印',
            itemId: 'print',
            iconCls: 'print'
        },
        {
            xtype: 'button',
            text: 'Export to PDF',
            itemId: 'pdf',
            iconCls: 'pdf'
        },*/
        {
            xtype: 'button',
            text: '输出到Excel',
            itemId: 'excel',
            iconCls: 'excel'
        },
        {
            xtype: 'tbseparator'
        },
        {
        	xtype:'combo',
        	itemId:'department',
        	store:'departments.DepartmentsList',
        	displayField:'dept_name',
        	valueField:'id',
        	emptyText:'请选择'
        },{
        	xtype:'textfield',
        	itemId:'name',
        	emptyText:'姓名学号模糊查找'
        },
        {
            xtype: 'button',
            text: '搜索',
            itemId: 'search',
            iconCls: 'search'}
        
    ]
});