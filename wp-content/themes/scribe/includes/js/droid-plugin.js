(function() {
 tinymce.create('tinymce.plugins.Droid', {
  init : function(ed, url) {
   ed.addButton('droid_title', {
   title : 'Droid Title',
   cmd : 'droid_title',
   image : url + '/droid.png'
  });
 
 ed.addCommand('droid_title', function() {
  var selected_text = ed.selection.getContent();
  var return_text = '';
  return_text = '<span class="droid_title">' + selected_text + '</span>';
  ed.execCommand('mceInsertContent', 0, return_text);
  });
 
 },
 
 });
 
// Register plugin
 tinymce.PluginManager.add( 'droid', tinymce.plugins.Droid );
})();