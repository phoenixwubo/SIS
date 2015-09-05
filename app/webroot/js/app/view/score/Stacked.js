//Ext JS Chart Kitchen Sink
//Stacked area are multi-series area charts where categories are stacked on top of each other. This is typically done to emphasize the quantity while comparing multiple categories.

Ext.define('SIS.view.score.Stacked', {
    extend: 'Ext.Panel',
    title:'Stacked',
//    xtype: 'stacked-area',
    alias: 'widget.stacked',
    layout: 'border',
//layout:'fit',
//    layout: {
//        type: 'table',
//        columns: 2
//    },
    initComponent: function() {
        var me = this;

        this.myDataStore = Ext.create('Ext.data.JsonStore', {
            fields: ['month', 'data1', 'data2', 'data3', 'data4' ],
            data: [
                { month: 'Jan', data1: 20, data2: 37, data3: 35, data4: 4 },
                { month: 'Feb', data1: 20, data2: 37, data3: 36, data4: 5 },
                { month: 'Mar', data1: 19, data2: 36, data3: 37, data4: 4 },
                { month: 'Apr', data1: 18, data2: 36, data3: 38, data4: 5 },
                { month: 'May', data1: 18, data2: 35, data3: 39, data4: 4 },
                { month: 'Jun', data1: 17, data2: 34, data3: 42, data4: 4 },
                { month: 'Jul', data1: 16, data2: 34, data3: 43, data4: 4 },
                { month: 'Aug', data1: 16, data2: 33, data3: 44, data4: 4 },
                { month: 'Sep', data1: 16, data2: 32, data3: 44, data4: 4 },
                { month: 'Oct', data1: 16, data2: 32, data3: 45, data4: 4 },
                { month: 'Nov', data1: 15, data2: 31, data3: 46, data4: 4 },
                { month: 'Dec', data1: 15, data2: 31, data3: 47, data4: 4 }
            ]
        });

        me.items = [
{
    region: 'north',            //子元素的方位：north、west、east、center、south
    title: '北',
    xtype: "panel",
//    layout:'fit',
    items:[{
    	
//    	
            xtype: 'chart',
//            width: '100%',
            width:800,
            height: 410,
            padding: '10 0 0 0',
            animate: true,
            shadow: false,
            style: 'background: #fff;',
            legend: {
                position: 'right',
                boxStrokeWidth: 0,
                labelFont: '12px Helvetica'
            },
            store: this.myDataStore,
            insetPadding: 40,
            items: [{
                type  : 'text',
                text  : 'Area Charts - Stacked Area',
                font  : '22px Helvetica',
                width : 100,
                height: 30,
                x : 40, //the sprite x position
                y : 12  //the sprite y position
            },{
                type: 'text',
                text: 'Data: Browser Stats 2012',
                font: '10px Helvetica',
                x: 12,
                y: 380
            }, {
                type: 'text',
                text: 'Source: http://www.w3schools.com/',
                font: '10px Helvetica',
                x: 12,
                y: 390
            }],
            axes: [{
                type: 'numeric',
                fields: 'data1',
                position: 'left',
                grid: true,
                minimum: 0,
                label: {
                    renderer: function(v) { return v + '%'; }
                }
            }, {
                type: 'category',
                fields: 'month',
                position: 'bottom',
                grid: true,
                label: {
                    rotate: {
                        degrees: -45
                    }
                }
            }],
            series: [{
                type: 'area',
                axis: 'left',
                title: [ 'IE', 'Firefox', 'Chrome', 'Safari' ],
                xField: 'month',
                yField: [ 'data1', 'data2', 'data3', 'data4' ],
                style: {
                    opacity: 0.80
                },
                highlight: {
                    fill: '#000',
                    'stroke-width': 2,
                    stroke: '#fff'
                },
                tips: {
                    trackMouse: true,
                    style: 'background: #FFF',
                    height: 20,
                    renderer: function(storeItem, item) {
                    	console.log(item.series.title);
                        var browser = item.series.title[Ext.Array.indexOf(item.series.yField, item.storeField)];
                        this.setTitle(browser + ' for ' + storeItem.get('month') + ': ' + storeItem.get(item.storeField) + '%');
                    }
                }
            }]
//    	
    	
    	
    	
    }
           
           ]
,
//    html: "子元素1",
    height: 500
}, {
    region: 'west',
    title: '西',
    xtype: "panel",
    html: "子元素2",
    width: 100

}, {
    region: 'east',
    title: '东',
    xtype: "panel",
    html: "子元素2",
    width: 100

}, {
    region: 'center',
    title: '主体',
    xtype: "panel",
    html: "子元素3"
}, {
    region: 'south',
    title: '南',
    xtype: "panel",
    html: "子元素4",
    height: 70
},
                    {/*
            xtype: 'chart',
//            width: '100%',
            rowspan: 1,
            height: 410,
//            padding: '10 0 0 0',
            animate: true,
            shadow: false,
            style: 'background: #fff;',
            legend: {
                position: 'right',
                boxStrokeWidth: 0,
                labelFont: '12px Helvetica'
            },
            store: this.myDataStore,
            insetPadding: 40,
            items: [{
                type  : 'text',
                text  : 'Area Charts - Stacked Area',
                font  : '22px Helvetica',
                width : 100,
                height: 30,
                x : 40, //the sprite x position
                y : 12  //the sprite y position
            }, {
                type: 'text',
                text: 'Data: Browser Stats 2012',
                font: '10px Helvetica',
                x: 12,
                y: 380
            }, {
                type: 'text',
                text: 'Source: http://www.w3schools.com/',
                font: '10px Helvetica',
                x: 12,
                y: 390
            }],
            axes: [{
                type: 'numeric',
                fields: 'data1',
                position: 'left',
                grid: true,
                minimum: 0,
                label: {
                    renderer: function(v) { return v + '%'; }
                }
            }, {
                type: 'category',
                fields: 'month',
                position: 'bottom',
                grid: true,
                label: {
                    rotate: {
                        degrees: -45
                    }
                }
            }],
            series: [{
                type: 'area',
                axis: 'left',
                title: [ 'IE', 'Firefox', 'Chrome', 'Safari' ],
                xField: 'month',
                yField: [ 'data1', 'data2', 'data3', 'data4' ],
                style: {
                    opacity: 0.80
                },
                highlight: {
                    fill: '#000',
                    'stroke-width': 2,
                    stroke: '#fff'
                },
                tips: {
                    trackMouse: true,
                    style: 'background: #FFF',
                    height: 20,
                    renderer: function(storeItem, item) {
                        var browser = item.series.title[Ext.Array.indexOf(item.series.yField, item.storeField)];
                        this.setTitle(browser + ' for ' + storeItem.get('month') + ': ' + storeItem.get(item.storeField) + '%');
                    }
                }
            }]
        */}];

        this.callParent();
    }
});














//
//
//
//{
//
//	    region: 'center',            //子元素的方位：north、west、east、center、south
//	    xtype: "panel",
//	    layout:'fit',
//	    items:[{
//id:'sectionchart',
//			xtype : 'chart',
//			padding: '10 0 0 0',
//			style : 'background:#fff',
//			animate : true,
//			shadow : true,
//			store : 'scores.ScoreSections',
//			insetPadding: 40,
//			legend : {
//				position : 'right',
//				boxStrokeWidth : 0,
//				labelFont : '12px Helvetica'
//			},
//			items : [ {/*
//				type : 'text',
//				text : '分数段统计',
//				font : '22px Helvetica',
//				width : 100,
//				height : 30,
//				x : 40, //the sprite x position
//				y : 12
//			//the sprite y position
//			*/} ],
//			axes : [ {
//				type : 'Numeric',
//				position : 'left',
//				fields : [],
//
//				/*            label: {
//				 renderer: Ext.util.Format.numberRenderer('0,0')
//				 },*/
//				title : '分数段人数',
//				grid : true,
//				//    grid: {
//				//        odd: {
//				//            opacity: 1,
//				//            fill: '#ddd',
//				//            stroke: '#bbb',
//				//            'stroke-width': 1
//				//        }
//				//    },
//				minimum : 0,
//				maximum: 40
//			//    adjustMinimumByMajorUnit: 0
//			}, {
//				type : 'Category',
//				position : 'bottom',
//				fields : [ 'section' ],
//				title : '分数段',
//				label : {
//					rotate : {
//						degrees : -45
//					}
//				}
//			} ],
//			series : [ /* {
//			type: 'line',
//			axis: 'left',
//			xField: 'section',
//			yField: '2014201',
//			}*/
//
//			]
//		}
//	           
//	           ]
//	,
//  width: 800
//
//},
//
//{
//	    region: 'west',
//	    id:'west',
//	    xtype: "panel",
//	    layout:'fit',
//	    items:[{
//	    	
//
//	    	
////	    	
//	            xtype: 'chart',
////	            width: '100%',
//	            id:'areachart',
////	            width:200,
////	            height: 410,
//	            padding: '10 0 0 0',
//	            animate: true,
//	            shadow: false,
//	            style: 'background: #fff;',
//	            legend: {
//	                position: 'right',
//	                boxStrokeWidth: 0,
//	                labelFont: '12px Helvetica'
//	            },
//	            store : 'scores.ScoreSections',
//	            insetPadding: 40,
//	            items: [],
//	            axes: [{
//	                type: 'numeric',
////	                fields: '',
//	                position: 'left',
//	                grid: true,
//	                minimum: 0,
//	                maximum:100,
////	                label: {
////	                    renderer: function(v) { return v + '%'; }
////	                }
//	            }, {
//	                type: 'category',
//	                fields: 'section',
//	                position: 'bottom',
//	                grid: true,
//	                label: {
//	                    rotate: {
//	                        degrees: -45
//	                    }
//	                }
//	            }],
//	            series: [{
//	                type: 'area',
//	                axis: 'left',
////	                title: [ 'IE', 'Firefox', 'Chrome', 'Safari' ],
////	                xField: 'section',
////	                yField:[ '2014201','2014202'],
//	                style: {
//	                    opacity: 0.80
//	                },
//	                highlight: {
//	                    fill: '#000',
//	                    'stroke-width': 2,
//	                    stroke: '#fff'
//	                },
//	                tips: {
//	                    trackMouse: true,
//	                    style: 'background: #FFF',
//	                    height: 20,
//	                    renderer: function(storeItem, item) {
//	                        var department = item.series.title/*[Ext.Array.indexOf(item.series.yField, item.storeField)]*/;
//	                        this.setTitle(browser + ' for ' + storeItem.get('section') + ': ' + storeItem.get(item.storeField) + '人');
//	                    }
//	                }
//	            }]
////	    	
//	    	
//	    	
//	    	
//	    
//	    }
//	           
//	           ]
//
//	},
////    {
////  	  region:'east',
////  	  id:'east',
////  	  
//////  	  xtype:'grid',
//////  	  columns: [],
////  	  layou:'vbox',
////  	  xtype:'panel',
////  	  items:[{
////  		  flex:1,
////  		  xtype:'grid',
////  		  columns: [],
////  		  
////  	  }
////  	         
////  	         ]
////	
////  	  
////    },
//    {
//	    region: 'south',
////	    title: '平均分',
//	    xtype: "panel",
//	    layout:'fit',
////	    html: "子元素3",
//	    
//	    height:150,
//	    items:[{
//	    	padding: '10 0 0 0',
//	    	xtype:'chart',
//	    	animate: true,
//	        shadow: true,
//	        id:'averagechart',
//	        store:'scores.Averages',
//	        axes: [{
//	            type: 'Numeric',
//	            position: 'left',
//	            fields: ['average'],
////	            label: {
////	                renderer: Ext.util.Format.numberRenderer('0,0')
////	            },
//	            title: '平均分',
//	            grid: true,
//	            maximum:100,
//	            minimum: 0
//	        }, {
//	            type: 'Category',
//	            position: 'bottom',
//	            fields: ['dept_number'],
//	            title: '班级'
//	        }],
//	        series: [{
//	            type: 'column',
//	            axis: 'left',
//	            highlight: true,
//	            tips: {
//	                trackMouse: true,
//	                renderer: function(storeItem, item) {
//	                    this.setTitle(storeItem.get('name') + ': ' + storeItem.get('data1') + ' $');
//	                }
//	            },
//	            label: {
//	                display: 'outside',
//	                'text-anchor': 'middle',
//	                field: 'average',
//	                renderer: Ext.util.Format.numberRenderer('0.0'),
////	                orientation: 'vertical',
//	                color: '#333'
//	            },
//	            xField: 'dept_number',
//	            yField: 'average'
//	        }]
//	    }]
//	    
//	    	
//} 