<?php

namespace Robust\DynamicForms\Helpers;

use Illuminate\Database\Eloquent\Collection;
use Robust\DynamicForms\Models\Data;
use Robust\DynamicForms\Models\Form;
use Robust\DynamicForms\Models\FormField;

/**
 * Class FormHelper
 * @package Fdw\DynamicForm\Helpers
 */
class FormHelper
{
    /**
     * @param $attr
     * @param null $content
     * @param null $name
     * @return string
     */
    public function shortcode($attr, $content = null, $name = null)
    {
        $data_id = 0;
        $model = [];

        if ($attr->data_id) {
            $data_id = $attr->data_id;
        }

        $form = Form::where(['title' => $content])->first();
        if (!$form) {
            return;
        }

        if (self::isSingleSubmit($form->id)) {
            $data = Data::where('user_id', \Auth::id())->where('form_id', $form->id)->first();
        } else if ($data_id > 0) {
            $data = Data::find($data_id);
        }

        if (isset($data)) {
            $model = $data ? json_decode($data->values, true) : [];
            $model['data_id'] = $data_id;
        }

        $model['preview'] = false;
        if ($attr->preview == "true") {
            $model['preview'] = true;
        }

        if (isset($attr->print)) {
            $model['print'] = $attr->print;
        }

        return $this->displayForm($form, $model);
    }

    /**
     * @param $form
     * @param $model
     * @return string
     */
    public static function displayForm($form, $model)
    {
        $pages = '';
        $count = $form->pages;
        for ($page = 1; $page <= $count; $page++) {

            $first = ($page == 1) ? true : false;
            $last = ($page == $count) ? true : false;

            $fields_to_display = '';
            $form_id = $form->id;

            // Get Forms of the Page
            $form_fields = FormField::where('form_id', '=', $form->id)
                ->where('page_no', '=', $page)
                ->where('section_id', '=', 0)
                ->orderBy('order')
                ->get();

            foreach ($form_fields as $form_field) {
                $properties = json_decode($form_field->properties);
                $form_helper = new self;
                $form_field = (object)self::getAllFieldsTreeByFieldId($form_field->id);

                $fields_to_display .= view("dynamic-forms::admin.forms.display.{$form_field->type}",
                    compact('form', 'form_field', 'properties', 'data', 'form_helper', 'form_id', 'model', 'target'));
            }
            $pages .= view('dynamic-forms::admin.forms.display.partials.form-pages',
                compact('fields_to_display', 'page', 'count', 'model', 'form_id', 'first', 'last'));
        }

        $form_to_display = view("dynamic-forms::admin.forms.display.form", compact('form', 'model', 'pages'));
        return $form_to_display;
    }

    /**
     * @param $form
     * @param int $starting_from_page
     * @return array
     */
    public function getPages($form, $starting_from_page = 1)
    {
        $pages = [];
        foreach (range($starting_from_page, $form->pages) as $page) {
            $pages[$page] = $page;
        }
        return $pages;
    }

    /**
     * @param $options
     * @return Collection
     */
    public function getOptions($options)
    {
        if ($options == "") {
            return [];
        }

        $array_collection = new Collection;

        $options_array = explode(",", $options);

        foreach ($options_array as $key => $value) {
            $array_collection->push($value);
        }

        return array_combine($array_collection->toArray(), $array_collection->toArray());
    }

    /**
     * @param $form_id
     * @return mixed
     */
    public function hasData($form_id)
    {
        return FormData::where('form_id', $form_id)->count();
    }

    /**
     * @param $form_field_id
     * @return string
     */
    public function getLabel($form_field_id)
    {
        $form_field = FormField::find($form_field_id);
        return ($form_field) ? $form_field->label : '';
    }

    /**
     * @param $field_name
     * @return string
     */
    public function getLabelByName($field_name)
    {
        $form_field = FormField::where('name', $field_name)->first();
        return ($form_field) ? $form_field->label : '';
    }


    /**
     * @return string
     */
    public function setLabelInArray($datas)
    {
        $data_with_label = [];
        foreach ($datas as $key => $data) {
            $data_with_label[] = [$this->getLabel($key) => $data];
        }

        return $data_with_label;
    }

    /**
     * @param $datas
     * @return array
     */
    public function setDataInArray($datas)
    {
        $data_with_label = [];

        foreach ($datas as $key => $data) {
            $field = FormField::find($key);
            if ($field)
                $data_with_label += [$key => $data];
        }

        return $data_with_label;
    }


    /**
     * @param $name
     * @return string
     */
    public function getQuestion($name)
    {
        $field = FormField::where('name', $name)->first();

        return ($field) ? $field->label : "";
    }


    /**
     * @param $field
     * @param $model
     * @param $value
     * @return bool
     */
    public function getCheckedValues($field, $model, $value)
    {
        $data = isset($model[$field]) ? $model[$field] : [];
        return in_array($value, $data) ? true : false;
    }

    /**
     * @param $id
     * @return bool
     */
    public function isSingleSubmit($id)
    {
        $form = Form::find($id);

        return ($form->single_submit) ? true : false;
    }

    /**
     * @param $form_field_id
     * @return mixed
     */
    public static function getAllFieldsTreeByFieldId($form_field_id)
    {
        $all_form_fields = [];
        $form_fields = FormField::where('id', $form_field_id)
            ->orWhere('section_id', $form_field_id)
            ->orderBy('page_no')
            ->orderBy('order')->get();

        foreach ($form_fields as $field) {
            if ($field->section_id == 0) {
                $all_form_fields[$field->id] = array_merge($field->toArray(), ['childrens' => []]);
            } else {
                $all_form_fields[$field->section_id]['childrens'][$field->column_no][] = $field->toArray();
            }
        }
        return $all_form_fields[$form_field_id];
    }


    /**
     * @return Collection|static[]
     */
    public function getForms()
    {
        return Form::all();
    }

    /**
     * @return mixed
     */
    public function getAllFormsL()
    {
        return Form::pluck('title', 'id');
    }

    /**
     * @return string
     */
    public function setLabelForRow($datas)
    {
        $data_with_label = [];

        foreach ($datas as $key => $data) {
            $label = $this->getLabel($key);
            $label = ($label === '') ? $key : $label;
            $data_with_label[$label] = $data;
        }
        return $data_with_label;
    }

    /**
     * @return array
     */
    public function getCountries()
    {
        return array(
            "Afghanistan" => "Afghanistan",
            "Albania" => "Albania",
            "Algeria" => "Algeria",
            "Algeria" => "Algeria",
            "Algeria" => "Algeria",
            "Antigua and Barbuda" => "Antigua and Barbuda",
            "Argentina" => "Argentina",
            "Armenia" => "Armenia",
            "Australia" => "Australia",
            "Austria" => "Austria",
            "Azerbaijan" => "Azerbaijan",
            "Bahamas" => "Bahamas",
            "Bahrain" => "Bahrain",
            "Bangladesh" => "Bangladesh",
            "Barbados" => "Barbados",
            "Belarus" => "Belarus",
            "Belgium" => "Belgium",
            "Belize" => "Belize",
            "Benin" => "Benin",
            "Bhutan" => "Bhutan",
            "Bolivia" => "Bolivia",
            "Bosnia and Herzegovina" => "Bosnia and Herzegovina",
            "Botswana" => "Botswana",
            "Brazil" => "Brazil",
            "Brunei" => "Brunei",
            "Bulgaria" => "Bulgaria",
            "Burkina Faso" => "Burkina Faso",
            "Burundi" => "Burundi",
            "Cambodia" => "Cambodia",
            "Cameroon" => "Cameroon",
            "Canada" => "Canada",
            "Cape Verde" => "Cape Verde",
            "Central African Republic" => "Central African Republic",
            "Chad" => "Chad",
            "Chile" => "Chile",
            "China" => "China",
            "Colombi" => "Colombi",
            "Comoros" => "Comoros",
            "Congo (Brazzaville)" => "Congo (Brazzaville)",
            "Congo" => "Congo",
            "Costa Rica" => "Costa Rica",
            "Cote d'Ivoire" => "Cote d'Ivoire",
            "Croatia" => "Croatia",
            "Cuba" => "Cuba",
            "Cyprus" => "Cyprus",
            "Czech Republic" => "Czech Republic",
            "Denmark" => "Denmark",
            "Djibouti" => "Djibouti",
            "Dominica" => "Dominica",
            "Dominican Republic" => "Dominican Republic",
            "East Timor (Timor Timur)" => "East Timor (Timor Timur)",
            "Ecuador" => "Ecuador",
            "Egypt" => "Egypt",
            "El Salvador" => "El Salvador",
            "Equatorial Guinea" => "Equatorial Guinea",
            "Eritrea" => "Eritrea",
            "Estonia" => "Estonia",
            "Ethiopia" => "Ethiopia",
            "Fiji" => "Fiji",
            "Finland" => "Finland",
            "France" => "France",
            "Gabon" => "Gabon",
            "Gambia, The" => "Gambia, The",
            "Georgia" => "Georgia",
            "Germany" => "Germany",
            "Ghana" => "Ghana",
            "Greece" => "Greece",
            "Grenada" => "Grenada",
            "Guatemala" => "Guatemala",
            "Guinea" => "Guinea",
            "Guinea-Bissau" => "Guinea-Bissau",
            "Guyana" => "Guyana",
            "Haiti" => "Haiti",
            "Honduras" => "Honduras",
            "Hungary" => "Hungary",
            "Iceland" => "Iceland",
            "India" => "India",
            "Indonesia" => "Indonesia",
            "Iran" => "Iran",
            "Iraq" => "Iraq",
            "Ireland" => "Ireland",
            "Israel" => "Israel",
            "Italy" => "Italy",
            "Jamaica" => "Jamaica",
            "Japan" => "Japan",
            "Jordan" => "Jordan",
            "Kazakhstan" => "Kazakhstan",
            "Kenya" => "Kenya",
            "Kiribati" => "Kiribati",
            "Korea, North" => "Korea, North",
            "Korea, South" => "Korea, South",
            "Kuwait" => "Kuwait",
            "Kyrgyzstan" => "Kyrgyzstan",
            "Laos" => "Laos",
            "Latvia" => "Latvia",
            "Lebanon" => "Lebanon",
            "Lesotho" => "Lesotho",
            "Liberia" => "Liberia",
            "Libya" => "Libya",
            "Liechtenstein" => "Liechtenstein",
            "Lithuania" => "Lithuania",
            "Luxembourg" => "Luxembourg",
            "Macedonia" => "Macedonia",
            "Madagascar" => "Madagascar",
            "Malawi" => "Malawi",
            "Malaysia" => "Malaysia",
            "Maldives" => "Maldives",
            "Mali" => "Mali",
            "Malta" => "Malta",
            "Marshall Islands" => "Marshall Islands",
            "Mauritania" => "Mauritania",
            "Mauritius" => "Mauritius",
            "Mexico" => "Mexico",
            "Micronesia" => "Micronesia",
            "Moldova" => "Moldova",
            "Monaco" => "Monaco",
            "Mongolia" => "Mongolia",
            "Morocco" => "Morocco",
            "Mozambique" => "Mozambique",
            "Myanmar" => "Myanmar",
            "Namibia" => "Namibia",
            "Nauru" => "Nauru",
            "Nepal" => "Nepal",
            "Netherlands" => "Netherlands",
            "New Zealand" => "New Zealand",
            "Nicaragua" => "Nicaragua",
            "Niger" => "Niger",
            "Nigeria" => "Nigeria",
            "Norway" => "Norway",
            "Oman" => "Oman",
            "Pakistan" => "Pakistan",
            "Palau" => "Palau",
            "Panama" => "Panama",
            "Papua New Guinea" => "Papua New Guinea",
            "Paraguay" => "Paraguay",
            "Peru" => "Peru",
            "Philippines" => "Philippines",
            "Poland" => "Poland",
            "Portugal" => "Portugal",
            "Qatar" => "Qatar",
            "Romania" => "Romania",
            "Russia" => "Russia",
            "Rwanda" => "Rwanda",
            "Saint Kitts and Nevis" => "Saint Kitts and Nevis",
            "Saint Lucia" => "Saint Lucia",
            "Saint Vincent" => "Saint Vincent",
            "Samoa" => "Samoa",
            "San Marino" => "San Marino",
            "Sao Tome and Principe" => "Sao Tome and Principe",
            "Saudi Arabia" => "Saudi Arabia",
            "Senegal" => "Senegal",
            "Serbia and Montenegro" => "Serbia and Montenegro",
            "Seychelles" => "Seychelles",
            "Sierra Leone" => "Sierra Leone",
            "Singapore" => "Singapore",
            "Slovakia" => "Slovakia",
            "Slovenia" => "Slovenia",
            "Solomon Islands" => "Solomon Islands",
            "Somalia" => "Somalia",
            "South Africa" => "South Africa",
            "Spain" => "Spain",
            "Sri Lanka" => "Sri Lanka",
            "Sudan" => "Sudan",
            "Suriname" => "Suriname",
            "Swaziland" => "Swaziland",
            "Sweden" => "Sweden",
            "Switzerland" => "Switzerland",
            "Syria" => "Syria",
            "Taiwan" => "Taiwan",
            "Tajikistan" => "Tajikistan",
            "Tanzania" => "Tanzania",
            "Thailand" => "Thailand",
            "Togo" => "Togo",
            "Tonga" => "Tonga",
            "Trinidad and Tobago" => "Trinidad and Tobago",
            "Tunisia" => "Tunisia",
            "Turkey" => "Turkey",
            "Turkmenistan" => "Turkmenistan",
            "Tuvalu" => "Tuvalu",
            "Uganda" => "Uganda",
            "Ukraine" => "Ukraine",
            "United Arab Emirates" => "United Arab Emirates",
            "United Kingdom" => "United Kingdom",
            "United States" => "United States",
            "Uruguay" => "Uruguay",
            "Uzbekistan" => "Uzbekistan",
            "Vanuatu" => "Vanuatu",
            "Vatican City" => "Vatican City",
            "Venezuela" => "Venezuela",
            "Vietnam" => "Vietnam",
            "Yemen" => "Yemen",
            "Zambia" => "Zambia",
            "Zimbabwe" => "Zimbabwe");
    }
}
