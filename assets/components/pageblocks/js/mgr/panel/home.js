PageBlocks.panel.Home=function(e){e=e||{},Ext.apply(e,{baseCls:"modx-formpanel",layout:"anchor",hideMode:"offsets",items:[{html:"<h2>"+_("pageblocks")+" ("+_("pb_constrtuctor").toLowerCase()+")</h2>",cls:"pb-header-panel",style:{margin:"15px 0"}},{xtype:"modx-tabs",defaults:{border:!1,autoHeight:!0},border:!0,hideMode:"offsets",cls:"pb-tab-panel",id:"pb-panel-tabs",stateful:!0,stateId:"pb-panel-home",stateEvents:["tabchange"],getState:function(){return{activeTab:this.items.indexOf(this.getActiveTab())}},items:[{title:_("pb_blocks"),layout:"anchor",items:[{html:_("pb_intro_msg"),cls:"panel-desc pb-panel-desc"},{xtype:"pb-grid-blocks",cls:"main-wrapper"}]},{title:_("pb_tables"),layout:"anchor",items:[{html:_("pb_intro_msg"),cls:"panel-desc pb-panel-desc"},{xtype:"pb-grid-tables",cls:"main-wrapper"}]}]}]}),PageBlocks.panel.Home.superclass.constructor.call(this,e)},Ext.extend(PageBlocks.panel.Home,MODx.Panel),Ext.reg("pb-panel-home",PageBlocks.panel.Home);