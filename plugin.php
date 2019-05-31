<?php
/**
 * Plugin Name: Vales WP Markdown Editor
 * Description: Silence is golden.
 * Version: 1.0.0
 * Author: Vales Digital
 * Author URI: https://valesdigital.com/
 * GitHub Plugin URI: valesdev/vales-wp-markdown-editor
 */

class _WP_Editors {
  public static function editor ($content, $editor_id, $settings = array()) {
    $content = apply_filters('the_editor_content', $content);
    $settings = array_merge(array(
      'textarea_name' => $editor_id,
    ), $settings);
    ?>
    <div>
      <textarea name="<?php echo esc_attr($settings['textarea_name']); ?>" id="<?php echo esc_attr($editor_id); ?>" cols="40" class="markdown-editor" style="height: 300px;"><?php echo $content; ?></textarea>
    </div>
    <?php
  }
}

add_action('admin_enqueue_scripts', function () {
  wp_register_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css', array(), '4.7.0', 'all');
  wp_enqueue_style('font-awesome');

  wp_register_style('simplemde', 'https://cdnjs.cloudflare.com/ajax/libs/simplemde/1.11.2/simplemde.min.css', array(), '1.11.2', 'all');
  wp_enqueue_style('simplemde');

  wp_register_script('simplemde', 'https://cdnjs.cloudflare.com/ajax/libs/simplemde/1.11.2/simplemde.min.js', array(), '1.11.2', true);
  wp_enqueue_script('simplemde');
});

add_action('admin_head', function () {
  ?>
  <style type="text/css">
    .editor-toolbar { margin-top: 20px; }
    .CodeMirror { font-family: Consolas, Monaco, 'Courier New', Courier, monospace; }
  </style>
  <?php
});

add_action('admin_footer', function () {
  ?>
  <script type="application/javascript">
    window.document.addEventListener('DOMContentLoaded', function () {
      var elements = window.document.getElementsByClassName('markdown-editor');
      if (elements.length > 0) {
        for (let i = 0; i < elements.length; i++) {
          new SimpleMDE({
            element: elements[i],
            status: false,
            spellChecker: false,
            promptURLs: false,
            autoDownloadFontAwesome: false,
            tabSize: 4,
            initialValue: '',
            placeholder: '',
          });
        }
      }
    }, false);
  </script>
  <?php
});
