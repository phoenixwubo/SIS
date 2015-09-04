 Ext.define('Average', {
     extend: 'Ext.data.Model',
     fields: ['dept_number','average'
     ]
 });
Ext.define('SIS.store.scores.Averages', {
    extend: 'Ext.data.Store',
    model: 'Average',
    autoLoad:false,
    reader: {
        type: 'json',
        root: 'averageInJson',
        totalProperty:'totalDepartment',
        successProperty: 'success'
    }});