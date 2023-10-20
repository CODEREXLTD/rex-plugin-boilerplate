<?php

namespace RexTheme\PluginName\Assets;

class LoadAssets
{
    public function admin()
    {
        Vite::enqueueScript('plugin-name-script-boot', 'admin/start.js', array('jquery'), _PLUGIN_NAME_VERSION, true);
    }
  
}
