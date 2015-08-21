Ext.define('SIS.view.student.NativePlaceChart', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.studentchart',
    title: 'Student Chart',
    layout: 'fit',
    bodyPadding: 10,
    frame: true,
    autoShow: true,
    tbar: [{
        text: '保存图表',
/*        handler: function() {
            Ext.MessageBox.confirm('Confirm Download', 'Would you like to download the chart as an image?', function(choice){
                if(choice == 'yes'){
                    chart.save({
                        type: 'image/png'
                    });
                }
            });
        }*/
        itemId:'download',
        iconCls:'save'
    }, /*{
        text: '重新载入',
        itemId:'reload',
        iconCls:'refresh',
//        handler: function() {
//            // Add a short delay to prevent fast sequential clicks
//            window.loadTask.delay(100, function() {
//                store1.loadData(generateData());
//            });
//        }
    }, {
        enableToggle: true,
        pressed: true,
        text: '动画效果',
        toggleHandler: function(btn, pressed) {
            this.Chart.animate = pressed ? { easing: 'ease', duration: 500 } : false;
        }
    },*/{

    	xtype:'combo',
    	itemId:'department',
    	store:'departments.DepartmentsList',
    	displayField:'dept_name',
    	valueField:'id',
    	emptyText:'请选择'
    
    }],
  //  initComponent:function() {
    	items:[{
    		xtype:'chart',
    		 title: 'Student Chart',
    		    layout: 'fit',
    		   
    		    store: 'students.NativePlaces',
    		    width: 400,
    		    height: 300,
    		    theme: 'Red',
//    		    style: 'background:#fff',
    		    animate: true,
    		    background: {
    		        gradient: {
    		            id: 'gradientId',
    		            angle: 45,
    		            stops: {
    		                0: {
    		                    color: '#fff'
    		                },
    		                100: {
    		                    color: '#ddd'
    		                }
    		            }
    		        }
    		    },
    			axes: [
    			        {
    			            title: '人数统计',
    			            type: 'Numeric',
    			            position: 'left',
    			            fields: ['number'],
    			            minimum: 0
//    			            maximum: 500
    			        },
    			        {
    			            title: '生源地分布',
    			            type: 'Category',
    			            position: 'bottom',
    			            fields: ['native_place'],
//    			            dateFormat: 'ga'
    			        }
    			    ],
    		    	    
    			    series: [
    			        {
    			            type: 'column',
    			            highlight: true,
    			            tips: {
    			              trackMouse: true,
    			              width: 140,
    			              height: 28,
    			              renderer: function(storeItem, item) {
    			                this.setTitle(storeItem.get('native_place') + ': ' + storeItem.get('number') + ' 人');
    			              }
    			            },
    			            label:{
    			            	display: 'outside',  
    			            	'text-anchor': 'middle',  
    			            	field: 'number',  
    			            	renderer: Ext.util.Format.numberRenderer('0'),  
//    			            	orientation: 'vertical',  
    			            	color: '#00F'  },
    			            xField: 'native_place',
    			            yField: 'number'
    			        }
    			    ]
    		
    	}],
    	
//    	
//    	
//	           this.callParent(arguments);
//	            }
});
//
//Ext.define('SIS.view.student.Chart', {
//    extend: 'Ext.chart.Chart',
//	//	extend: 'Ext.window.Window',
//    alias: 'widget.studentchart',
//   
//});

