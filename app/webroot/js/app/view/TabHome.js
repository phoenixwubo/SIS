Ext.define('SIS.view.TabHome' ,{
    extend: 'Ext.panel.Panel',
    alias: 'widget.tabhome',
   
    title: 'home',
    store:'Students',
    iconCls:'home',
    html: '<img src="img/page.jpg" />',
//    html:'<img src="js/resources/images/schoolPic1.jpg" width=800></img>',
    stripeRows: true
    });
