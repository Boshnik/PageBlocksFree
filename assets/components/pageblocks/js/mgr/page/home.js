PageBlocks.page.Home=function(o){o=o||{},Ext.applyIf(o,{components:[{xtype:"pb-panel-home",renderTo:"pb-panel-home-div"}],buttons:[{xtype:"button",cls:"primary-button",text:'<i class="icon icon-large icon-cubes"></i> '+_("pageblocks")+" PRO",handler:()=>{window.open("https://pageblocks.boshnik.com/")}},{xtype:"button",text:'<i class="icon icon-large icon-book"></i> '+_("pb_docs"),handler:()=>{window.open("https://pageblocks.boshnik.com/docs/")}}]}),PageBlocks.page.Home.superclass.constructor.call(this,o)},Ext.extend(PageBlocks.page.Home,MODx.Component),Ext.reg("pb-page-home",PageBlocks.page.Home);