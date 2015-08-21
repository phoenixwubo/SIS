Ext.define('SIS.view.toolbar.FiltSubject', {
    extend: 'Ext.toolbar.Toolbar',
    alias: 'widget.filtsubject',

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
    	fieldLabel:'学科',
    	labelWidth : 45,
    	labelAlign : 'right',
    	xtype:'combo',
    	itemId:'course',
    	store:'Courses',
    	displayField:'course_name',
    	valueField:'id',
    	emptyText:'请选择'
    
    },
    {
    	fieldLabel:'考试名称',
    	xtype:'combo',
    	labelWidth : 55,
    	labelAlign : 'right',
    	itemId:'exam_name',
    	store:'scores.ExamNames',
    	displayField:'exam_name',
    	valueField:'field',
    	emptyText:'请选择'
    
    },
    {
        text: '查询',
/*        handler: function() {
            Ext.MessageBox.confirm('Confirm Download', 'Would you like to download the chart as an image?', function(choice){
                if(choice == 'yes'){
                    chart.save({
                        type: 'image/png'
                    });
                }
            });
        }*/
        itemId:'search',
        iconCls:'fiter'
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