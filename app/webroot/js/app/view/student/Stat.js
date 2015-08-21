Ext.define('SIS.view.student.Stat' ,{
    extend: 'Ext.grid.Panel',
    alias: 'widget.studentstat',
   
    title: 'tongji',
    store:'students.NativePlaces',
    stripeRows: true,
	
    initComponent: function() {
		
        this.columns = [
            {header: '籍贯',  dataIndex: 'native_place',  flex: 1},            
            {header: '人数',  dataIndex: 'number',  flex: 1}, 
            
        ];
 
       


        this.callParent(arguments);
    }
});