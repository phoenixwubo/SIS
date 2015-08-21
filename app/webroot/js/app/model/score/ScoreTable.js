Ext.define('SIS.model.score.ScoreTable', {

    extend: 'Ext.data.Model',
    fields: [],
    uses:['SIS.model.Course'],
    associations: [{ type: 'belongsTo',name:'users', model: 'User', foreignKey: 'user_id' ,autoLoad:true} ]
});