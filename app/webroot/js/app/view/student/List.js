Ext.Loader.setPath('Ext.ux', 'js/src/ux');
Ext.define('SIS.view.student.List' ,{
    extend: 'Ext.grid.Panel',
    alias: 'widget.studentlist',
   
    title: 'All students',
    store:'Students',
    stripeRows: true,
    dockedItems: [
                  {
                      xtype: 'addeditdeletesearch'
                  }],    
   /* renderGender:function(value){
    	
    	
		if(value==1){
			return "男";
	
		}else{
			return "女";
		}
	},
	 renderStatus:function(value){
		 switch (value)
	    	{
	    	case 1:return "正常";
	    	break;
	    	case 2:return '休学';
	    	break;
	    	case 3:return '毕业';
	    	break;
	    	case 4:return '旁听';
	    	break;
	    	case 5:return'复读';
	    	break;
	    	default :return '其他';
	    	}
		 },	*/
	requires: [
	           'Ext.ux.grid.FiltersFeature',
	           'SIS.util.Utilities'
	       ],
	 features: [{
	        ftype: 'filters',
	        // encode and local configuration options defined previously for easier reuse
	        encode: true, // json encode the filter query
	        //local: local,   // defaults to false (remote filtering)

	        // Filters are most naturally placed in the column definition, but can also be
	        // added here.
	        filters: [{
	            type: 'string',
	            dataIndex: 'name'
	        }]
	 }],
	//设置每页显示数量
	setLimit:function(){
		console.log(this.store.pageSize);
	},
	
    initComponent: function() {
		
        this.columns = [
            {header: 'ID',  dataIndex: 'id',  flex: 1},            
            {header: '姓名',  dataIndex: 'stu_name',  flex: 1}, 
            {

				header : '班级',
				dataIndex : 'dept_number',
				flex : 1,
				renderer : function(value, metaData, record) { // #2
					var departmentsStore = Ext.getStore('departments.DepartmentsRead');
					//var str=String(value).substring(0,7);
					//console.log(str);
					var department = departmentsStore.findRecord('dept_number', value);
					return department != null ? department.get('dept_name') : value;
				}
			
            },
            {header:'性别',dataIndex:'gender',flex:1,renderer:SIS.util.Utilities.renderGender},
            {header: '学号', dataIndex: 'stu_number', flex: 1},
            {header: '身份证号', dataIndex: 'id_card_number', flex: 1},
            {header: '出生日期',  dataIndex: 'dob',  flex: 1},
            {header: '学籍', dataIndex: 'status', flex: 1,renderer:SIS.util.Utilities.renderStatus},
            {header:'备注',dataIndex: 'note'}
            
        ];
 
        this.bbar = Ext.create('Ext.PagingToolbar', {  
            store: this.store,  
            
            displayInfo: true,  
            displayMsg: '显示 {0} - {1} 共计 {2}',  
            emptyMsg: '没有记录'/*,  
            items:[  
                '-', {  
                xtype: 'button',      
                text: '添加',  
                pressed: true,
                id:'add_student',
                enableToggle: true  
            },{  
                xtype: 'button',      
                text: '修改',  
                pressed: true,
                id:'edit_student',
                enableToggle: true  
            }
            ,{  
                xtype: 'button',      
                text: '删除',  
                pressed: true,
                id:'delete_student',
                enableToggle: true  
            }]  
*/        });  
       


        this.callParent(arguments);
    }
});