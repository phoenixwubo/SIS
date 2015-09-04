Ext.define('SIS.view.score.ScoreSectionChart', {
	extend : 'Ext.panel.Panel',
	alias : 'widget.scoresectionchart',
	title : 'Score Section Chart',
	layout : 'border',
	bodyPadding : 10,
	defaults: {
	    collapsible: true,
	    split: true,
//	    bodyPadding: 15
	},	
	frame : true,
	autoShow : true,
	initComponent : function() {
		this.dockedItems = [ {
			xtype : 'filtscore'
		} ];

		this.items = [
		              {

		            	    region: 'west',            //子元素的方位：north、west、east、center、south
//		            	    title: '北',
		            	    xtype: "panel",
		            	    layout:'fit',
		            	    items:[{
id:'sectionchart',
		            			xtype : 'chart',
		            			padding: '10 0 0 0',
		            			style : 'background:#fff',
		            			animate : true,
		            			shadow : true,
		            			store : 'scores.ScoreSections',
		            			insetPadding: 40,
		            			legend : {
		            				position : 'right',
		            				boxStrokeWidth : 0,
		            				labelFont : '12px Helvetica'
		            			},
		            			items : [ {/*
		            				type : 'text',
		            				text : '分数段统计',
		            				font : '22px Helvetica',
		            				width : 100,
		            				height : 30,
		            				x : 40, //the sprite x position
		            				y : 12
		            			//the sprite y position
		            			*/} ],
		            			axes : [ {
		            				type : 'Numeric',
		            				position : 'left',
		            				fields : [],

		            				/*            label: {
		            				 renderer: Ext.util.Format.numberRenderer('0,0')
		            				 },*/
		            				title : '分数段人数',
		            				grid : true,
		            				//    grid: {
		            				//        odd: {
		            				//            opacity: 1,
		            				//            fill: '#ddd',
		            				//            stroke: '#bbb',
		            				//            'stroke-width': 1
		            				//        }
		            				//    },
		            				minimum : 0,
		            				maximum: 40
		            			//    adjustMinimumByMajorUnit: 0
		            			}, {
		            				type : 'Category',
		            				position : 'bottom',
		            				fields : [ 'section' ],
		            				title : '分数段',
		            				label : {
		            					rotate : {
		            						degrees : -45
		            					}
		            				}
		            			} ],
		            			series : [ /* {
		            			type: 'line',
		            			axis: 'left',
		            			xField: 'section',
		            			yField: '2014201',
		            			}*/

		            			]
		            		}
		            	           
		            	           ]
		            	,
	            	    width: 800

		              }, {
		            	    region: 'center',
		            	    id:'center',
		            	    xtype: "panel",
		            	    layout:'fit',
		            	    items:[{
		            	    	

		            	    	
//		            	    	
		            	            xtype: 'chart',
//		            	            width: '100%',
		            	            id:'areachart',
		            	            width:400,
//		            	            height: 410,
		            	            padding: '10 0 0 0',
		            	            animate: true,
		            	            shadow: false,
		            	            style: 'background: #fff;',
		            	            legend: {
		            	                position: 'right',
		            	                boxStrokeWidth: 0,
		            	                labelFont: '12px Helvetica'
		            	            },
		            	            store : 'scores.ScoreSections',
		            	            insetPadding: 40,
		            	            items: [],
		            	            axes: [{
		            	                type: 'numeric',
//		            	                fields: '',
		            	                position: 'left',
		            	                grid: true,
		            	                minimum: 0,
		            	                maximum:100,
//		            	                label: {
//		            	                    renderer: function(v) { return v + '%'; }
//		            	                }
		            	            }, {
		            	                type: 'category',
		            	                fields: 'section',
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
//		            	                title: [ 'IE', 'Firefox', 'Chrome', 'Safari' ],
//		            	                xField: 'section',
//		            	                yField:[ '2014201','2014202'],
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
		            	                        var department = item.series.title/*[Ext.Array.indexOf(item.series.yField, item.storeField)]*/;
		            	                        this.setTitle(browser + ' for ' + storeItem.get('section') + ': ' + storeItem.get(item.storeField) + '人');
		            	                    }
		            	                }
		            	            }]
//		            	    	
		            	    	
		            	    	
		            	    	
		            	    
		            	    }
		            	           
		            	           ]

		            	}, {
		            	    region: 'south',
//		            	    title: '平均分',
		            	    xtype: "panel",
		            	    layout:'fit',
//		            	    html: "子元素3",
		            	    
		            	    height:150,
		            	    items:[{
		            	    	padding: '10 0 0 0',
		            	    	xtype:'chart',
		            	    	animate: true,
		            	        shadow: true,
		            	        id:'averagechart',
		            	        store:'scores.Averages',
		            	        axes: [{
		            	            type: 'Numeric',
		            	            position: 'left',
		            	            fields: ['average'],
		            	            label: {
		            	                renderer: Ext.util.Format.numberRenderer('0,0')
		            	            },
		            	            title: '平均分',
		            	            grid: true,
		            	            maximum:100,
		            	            minimum: 0
		            	        }, {
		            	            type: 'Category',
		            	            position: 'bottom',
		            	            fields: ['dept_number'],
		            	            title: '班级'
		            	        }],
		            	        series: [{
		            	            type: 'column',
		            	            axis: 'left',
		            	            highlight: true,
		            	            tips: {
		            	                trackMouse: true,
		            	                renderer: function(storeItem, item) {
		            	                    this.setTitle(storeItem.get('name') + ': ' + storeItem.get('data1') + ' $');
		            	                }
		            	            },
		            	            label: {
		            	                display: 'outside',
		            	                'text-anchor': 'middle',
		            	                field: 'average',
		            	                renderer: Ext.util.Format.numberRenderer('0'),
		            	                orientation: 'vertical',
		            	                color: '#333'
		            	            },
		            	            xField: 'dept_number',
		            	            yField: 'average'
		            	        }]
		            	    }]
		            	    
		            	    	
} ], this.callParent(arguments);
	}

});