Ext.define('SIS.view.toolbar.FilteElectiveCourse', {
    extend: 'Ext.toolbar.Toolbar',
    alias: 'widget.filtelecticourse',

//    flex: 1,
    dock: 'top',
    items: [
            {
        fieldLabel:'班级／年级',
        labelWidth : 65,
    	labelAlign : 'right',
    	xtype:'combo',
    	itemId:'department',
    	store:'departments.DepartmentsList',
    	displayField:'dept_name',
    	queryMode : 'remote',
    	valueField:'id',
    	
    	allowBlank :false,
    	emptyText:'班级／年级'
    
    },{
    	fieldLabel : '学期',
    	labelWidth : 55,
    	labelAlign : 'right',
    	xtype:'combo',
    	itemId:'semester',
    	store:'Semesters',
    	displayField:'sem_name',
    	queryMode : 'local',
    	valueField:'id',
    	emptyText:'请选择',
    
    },{
    	fieldLabel:'课程类型',
    	xtype:'combo',
    	labelWidth : 55,
    	labelAlign : 'right',
    	itemId:'course_type',
    	store:'coursePlans.CourseTypes',
    	displayField:'course_type',
    	valueField:'value',
    	emptyText:'请选择'
    
    },
    {
    	fieldLabel:'课程名称',
    	labelWidth : 65,
    	labelAlign : 'right',
    	xtype:'combo',
    	itemId:'course',
    	store:'courses.CoursesList',
    	displayField:'course_name',
    	valueField:'id',
    	emptyText:'请选择',
    		queryMode : 'local'
    
    },
  
    {
        text: '筛选',
/*        handler: function() {
            Ext.MessageBox.confirm('Confirm Download', 'Would you like to download the chart as an image?', function(choice){
                if(choice == 'yes'){
                    chart.save({
                        type: 'image/png'
                    });
                }
            });
        }*/
        itemId:'filter',
        iconCls:'filter'
    }/* ,
    {
        text: '下载',
       handler: function() {
            Ext.MessageBox.confirm('Confirm Download', 'Would you like to download the chart as an image?', function(choice){
                if(choice == 'yes'){
                    chart.save({
                        type: 'image/png'
                    });
                }
            });
        }
        itemId:'download',
        iconCls:'save'
    }*/]
});