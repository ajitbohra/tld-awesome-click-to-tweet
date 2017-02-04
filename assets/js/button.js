(function() {
  tinymce.PluginManager.add('tld_actt_button', function( editor, url ) {
    editor.addButton( 'tld_actt_button', {
      title: 'Awesome Click To Tweet',
      icon: 'icon dashicons-twitter',
      onclick: function() {
        editor.windowManager.open( {
          title: 'Awesome Click To Tweet',
          width: 650,
          minHeight: 450,
          id: 'TTTD',
          body: [
            {
            type: 'textbox',
            multiline: 'true',
            name: 'mask',
            label: 'Tweet mask',
            minHeight: 80
          },
          {
            type: 'textbox',
            multiline: 'true',
            name: 'tweet',
            label: 'Tweet',
            id: 'TEST',
            minHeight: 80
          },
          {
            type: 'textbox',
            name: 'btntext',
            label: 'Tweet button text',
            id: 'TEST2',
            maxLength: 30
          },
          {
            type: 'textbox',
            name: 'duration',
            label: 'Animation duration',
            maxLength: 1
          },
          {
            type: 'textbox',
            name: 'delay',
            label: 'Animation delay',
            maxLength: 1
          },
          {
            id: 'dDown',
            type: 'listbox',
            name: 'mfont',

            label: 'Tweet mask font',
            'values': [
              {text: 'Poiret One', value: 'poiret-one', id: 'TTT'},
              {text: 'Lobster Two', value: 'lobster-two'},
              {text: 'Raleway', value: 'raleway'},
              {text: 'Titillium Web', value: 'titillium-web'},
              {text: 'Indie Flower', value: 'indie-flower'}
            ],
            onselect: function() {
            //  alert('change');
              document.getElementById('mceu_77').classList.add('someClass');
              // document.getElementById('dDown').className += ' new-class';
              // var el = document.getElementById('dDown');
              // if(el) {
              //   el.className += el.className ? ' someClass' : 'someClass';
              // }
            },
          },
          {
            type: 'listbox',
            name: 'anim',
            label: 'Animation',
            'values': [
              {text: 'None', value: 'none'},
              {text: 'Pulse', value: 'pulse'},
              {text: 'Tada', value: 'tada'},
              {text: 'Bounce', value: 'bounce'}
            ]
          },
          {
            type: 'listbox',
            name: 'template',
            label: 'Template',
            'values': [
              {text: 'Big Button', value: 'bbutton'},
              {text: 'Dashed', value: 'dashed'},
              {text: 'Minimalist', value: 'minimalist'}
            ]
          },
        ],
        onsubmit: function( e ) {
          editor.insertContent( '[actt' + ' mask="' + e.data.mask + '"' + ' tweet="' + e.data.tweet + '"' + ' btn-text="' + e.data.btntext + '"' + ' duration="' + e.data.duration + '"' + ' delay="' + e.data.delay + '"' + ' font="' + e.data.mfont + '"' + ' anim="' + e.data.anim + '"' + ' template="' + e.data.template + '"' + ']');
        }
      });
    }
  });
});
})();
