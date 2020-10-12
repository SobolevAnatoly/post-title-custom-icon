<?php


namespace Posticon\Admin;

defined('ABSPATH') || exit;

class RegisterSettings
{
    private $options;

    public static function register()
    {
        $instance = new self;

        add_action('admin_init', [$instance, 'regSettings']);


    }

    public static function regSettings()
    {
        self::allSettings();
    }

    public function allSettings()
    {
        register_setting(
            'main-settings-group',
            'main_settings'
        );

        add_settings_section(
            'system_section',
            'System settings area',
            [$this, 'printSystemSectionInfo'],
            'pi-settings-page'
        );

        add_settings_section(
            'main_section',
            'Main settings area',
            [$this, 'printMainSectionInfo'],
            'pi-settings-page'
        );

        add_settings_field(
            'state',
            'ON\OF State',
            [$this, 'stateCallback'],
            'pi-settings-page',
            'system_section'
        );

    }

    public function printSystemSectionInfo()
    {
        print 'You can enable or disable the plugin here';
    }

    public function printMainSectionInfo()
    {
        print 'Make your settings below:';
    }

    public function stateCallback()
    {
        $this->setOptions('main_settings');

        printf(
            '<input type="checkbox" id="state" name="main_settings[state]" value="1" %s/>',
            isset($this->getOptions()['state']) ? checked(1, $this->getOptions()['state'], false) : ''
        );
    }

    /**
     * @return mixed
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param mixed $options
     */
    public function setOptions($options)
    {
        $this->options = get_option($options);
    }

}