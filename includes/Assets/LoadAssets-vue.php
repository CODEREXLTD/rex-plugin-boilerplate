<?php

namespace RexTheme\ThePluginName\Assets;

class LoadAssets
{
    public function admin()
    {
        Vite::enqueueScript('{{the-plugin-name}}', 'admin/start.js', array('jquery'), _PLUGIN_NAME_VERSION, true);
    }

}
