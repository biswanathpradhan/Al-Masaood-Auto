<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Package driver
    |--------------------------------------------------------------------------
    |
    | The package supports different drivers for translation management.
    |
    | Supported: "file", "database"
    |
    */
    'driver' => 'database',

    /*
    |--------------------------------------------------------------------------
    | Route group configuration
    |--------------------------------------------------------------------------
    |
    | The package ships with routes to handle language management. Update the
    | configuration here to configure the routes with your preferred group options.
    |
    */
    'route_group_config' => [
        'middleware' => ['web','auth'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Translation methods
    |--------------------------------------------------------------------------
    |
    | Update this array to tell the package which methods it should look for
    | when finding missing translations.
    |
    */
    'translation_methods' => ['trans', '__'],

    /*
    |--------------------------------------------------------------------------
    | Scan paths
    |--------------------------------------------------------------------------
    |
    | Update this array to tell the package which directories to scan when
    | looking for missing translations.
    |
    */
    'scan_paths' => [app_path(), resource_path()],

    /*
    |--------------------------------------------------------------------------
    | UI URL
    |--------------------------------------------------------------------------
    |
    | Define the URL used to access the language management too.
    |
    */
    'ui_url' => 'admin/languages',

    /*
    |--------------------------------------------------------------------------
    | Database settings
    |--------------------------------------------------------------------------
    |
    | Define the settings for the database driver here.
    |
    */
    'database' => [

        'connection' => 'mysql',

        'languages_table' => 'languages',

        'translations_table' => 'translations',
    ],


 'en' => [
    'languages' => 'Languages',
    'language' => 'Language',
    'type' => 'Type',
    'file' => 'File',
    'key' => 'Key',
    'prompt_language' => 'Enter the language code you would like to add (e.g. en)',
    'language_added' => 'New language added successfully 🙌',
    'prompt_language_for_key' => 'Enter the language for the key (e.g. en)',
    'prompt_type' => 'Is this a json or array key?',
    'prompt_file' => 'Which file will this be stored in?',
    'prompt_key' => 'What is the key for this translation?',
    'prompt_value' => 'What is the value for this translation',
    'type_error' => 'Translation type must be json or array',
    'language_key_added' => 'New language key added successfully 👏',
    'no_missing_keys' => 'There are no missing translation keys in the app 🎉',
    'keys_synced' => 'Missing keys synchronised successfully 🎊',
    'search' => 'Search all translations',
    'searchview' => 'search',
    'selectview' => 'select',
    'textview' => 'text',

    'translations' => 'Translation',
    'language_name' => 'Name',
    'locale' => 'Locale',
    'add' => '+ Add',
    'add_language' => 'Add a new language',
    'save' => 'Save',
    'language_exists' => 'The :attribute already exists.',
    'uh_oh' => 'Something\'s not quite right',
    'group_single' => 'Group / Single',
    'group' => 'Group',
    'single' => 'Single',
    'value' => 'Value',
    'namespace' => 'Namespace',
    'prompt_from_driver' => 'Which driver would you like to take translations from?',
    'prompt_to_driver' => 'Which driver would you like to add the translations to?',
    'prompt_language_if_any' => 'Which language? (leave blank for all)',
    'syncing' => 'Syncing translations ⏳',
    'synced' => 'Translations have been synced 😎',
    'invalid_driver' => 'Invalid driver',
    'invalid_language' => 'Invalid language',
    'add_translation' => 'Add a translation',
    'translation_added' => 'New translation added successfull 🙌',
    'namespace_label' => 'Namespace (Optional)',
    'group_label' => 'Group (Optional)',
    'key_label' => 'Key',
    'value_label' => 'Value',
    'namespace_placeholder' => 'e.g. my_package',
    'group_placeholder' => 'e.g. validation',
    'key_placeholder' => 'e.g. invalid_key',
    'value_placeholder' => 'e.g. Keys must be a single string',
    'advanced_options' => 'Toggle advanced options',
]

];
