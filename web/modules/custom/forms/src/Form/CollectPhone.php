<?php
/**
 * @file
 * Contains \Drupal\forms\Form\CollectPhone.
 *
 */

namespace Drupal\forms\Form;


use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\Logger;
use Drupal\user;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Mail\MailManagerInterface;
use Drupal\Component\Utility\SafeMarkup;
use Drupal\Component\Utility\Html;


/**
 *
 */
class CollectPhone extends FormBase {

    /**
     *
     * {@inheritdoc}.
     */
    public function getFormId() {
        return 'professions';
    }

    /**
     *
     * {@inheritdoc}.
     */
    public function buildForm(array $form, FormStateInterface $form_state) {

        $form['name'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Your name'),
            '#required' => TRUE,
        );
        $form['name']['#default_value'] = 'random';
        $form['surname'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Your surname'),
            '#required' => TRUE,
            '#default_value' => 'random',
        );
        $form['age'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Your age'),
            '#default_value' => 'random',
//            '#attributes' => ['id' => 'age-validation'],
//            '#ajax' => [
//              'callback' => '::validateAjax',
//              'event' => 'change',
//            ],
              '#prefix' => '<div id="age-validation"></div>',
        );
        $form['profession'] = array(
            '#type' => 'radios',
            '#title' => $this->t('profession'),
            '#options' => array('Student'=>t('Student'),'Engineer'=>t('Engineer'),'Doctor'=>t('Doctor')),
        );
        $form['experience'] = [
            '#type' => 'textfield',
            '#title' => t('How many years of experience'),
            '#states' => [
                    'visible' => [
                        ':input[name="profession"]' => [
                            ['value' => 'Engineer'],
                            ['value' => 'Doctor'],
                        ],
                    ],
                    'required' => [
                        ':input[name="profession"]' => [
                            ['value' => 'Engineer'],
                            ['value' => 'Doctor'],
                        ]
                    ]
                ]
            ];
        $form['clear'] = array(
            '#type' => 'button',
            '#value' => t('Clear'),
            '#attributes' => array('onclick' => 'this.form.reset(); return false;'),
//            '#prefix' => '<input type="reset" value="clear">',
        );
        $form['rebuild'] = array(
            '#type' => 'button',
            '#value' => t('Rebuild'),
            '#attributes' => array('id' => 'clear-button'),
        );

        $form['actions']['#type'] = 'actions';

        $form['actions']['submit']['#ajax'] = [
            'wrapper' => 'asjhdjkajksjhasd',
//            'callback' => array($this, 'ajaxRebuildCallback'),
            'effect' => 'fade',
        ];
        $form['actions']['submit'] = array(
            '#type' => 'submit',
            '#value' => $this->t('Send name and phone'),
            '#button_type' => 'primary',
            '#ajax' => [
                'callback' => '::validateAjax',
                'wrapper' => 'age-validation',
            ]
        );
        return $form;
    }

    /**
     * Validation of sent data in the form.
     *
     * {@inheritdoc}
     */
    public function validateForm(array &$form, FormStateInterface $form_state) {
//        $ajax_response = new AjaxResponse();

        if (strlen($form_state->getValue('name')) < 2) {
            $form_state->setErrorByName('name', $this->t('Name is too short.'));
        }
        if (strlen($form_state->getValue('surname')) < 2) {
            $form_state->setErrorByName('surname', $this->t('Surname is too short.'));
        }
        if (!is_numeric($form_state->getValue('age'))) {
            dump($form_state);
            $form_state->setErrorByName('age', $this->t('The value must be a number'));
//            $text = 'The value must be a number';
//            $ajax_response->addCommand(new HtmlCommand('.age-validation', $text));
        }
        if ($form_state->getValue('age') < 18) {
            $form_state->setErrorByName('age', $this->t('You Must Be 18 or Older to Register'));
        }
    }

    public function validateAjax(array &$form, FormStateInterface $form_state) {
//        $response = new AjaxResponse();
//        $response->addCommand(new HtmlCommand('.age-validation', 'Some'));
//        return $response;
        return $form['age'];

    }

    /**
     * Form submit .
     *
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
        $form_values = $form_state->getValues();
        switch ($form['#id']) {
            case 'professions':
                $date = date('d-m-Y H:i:s ');
                $mailManager = \Drupal::service('plugin.manager.mail');
                $module = "forms";
                $key = "professions";
                $to = "kruglov.denis3@gmail.com";
                $params['message'] = "Your profession form has been filled. Name: " . $form_values['name'] . ", Surname: " . $form_values['surname']
                  . ", Age: " . $form_values['age'] . ", Profession: " . $form_values['profession'] . ", experience: " . $form_values['experience'];
                $params['title'] = 'Test title';
                $langcode = \Drupal::currentUser()->getPreferredLangcode();
                $send = true;
                $result = $mailManager->mail($module, $key, $to, $langcode, $params, NULL, $send);
                if ($result['result'] == false) {
                    drupal_set_message(t("Error when sent profession form"));
                } else {
                    drupal_set_message(t("Profession form has been filled"));
                }

        }
//        // Output data like a system massage
//        drupal_set_message($this->t('Thank you @name, your phone number is @number', array(
//            '@name' => $form_state->getValue('name'),
//            '@number' => $form_state->getValue('phone_number')
//        )));
    }

}

//use Drupal\Core\Form\FormBase;
//use Drupal\Core\Form\FormStateInterface;
//
///**
// * Class PetsForm.
// */
//class CollectPhone extends FormBase {
//
//
//    /**
//     * {@inheritdoc}
//     */
//    public function getFormId() {
//        return 'form_demo_pets_form';
//    }
//
//    /**
//     * {@inheritdoc}
//     */
//    public function buildForm(array $form, FormStateInterface $form_state) {
//
//        $form['person'] = array(
//            '#type' => 'fieldset',
//            '#title' => ('Person'),
//        );
//
//        $form['person']['what_is_your_name'] = [
//            '#type' => 'textfield',
//            '#title' => t('What is your name?'),
//            '#title_display' => 'invisible',
//            '#default_value' => t('Alex'),
//
//            '#attributes' => [
//                'class' => ['class1', 'class2'],
//                'placeholder' => 'What is your name?'
//            ]
//        ];
//        $form['person']['age'] = [
//            '#type' => 'textfield',
//            '#title' => t('Age'),
//        ];
//
//        $form['who_do_you_prefer'] = [
//            '#type' => 'select',
//            '#title' => $this->t('Who do you prefer'),
//            '#options' => [
//                '' => t('Select your pet'),
//                'cats' => $this->t('cats'),
//                'cow'  => $this->t('cow'),
//                'dogs' => $this->t('dogs'),
//                'parrots' => $this->t('parrots'),
//                'fishes' => $this->t('fishes'),
//                'rabbits' => t('rabbits'),
//                'other' => $this->t('other')
//            ],
//            '#size' => 1,
//            '#required' => TRUE,
//            '#default_value' => 'dogs',
//            '#element_validate' => ['::validateElement'],
//        ];
//
//        $form['your_animal'] = [
//            '#type' => 'textfield',
//            '#title' => t('Your Animal'),
//            '#states' => [
//                // The state being affected is "invisible".
//                'invisible' => [
//                    // Drupal will only apply this state when the element that satisfies
//                    // the selector input[name="needs_accommodation"] is un-checked.
//                    ':input[name="who_do_you_prefer"]' => ['value' => 'other'],
//                ],
//            ],
//        ];
//
//        $form['submit'] = [
//            '#type' => 'submit',
//            '#value' => $this->t('Submit'),
//        ];
//
//        return $form;
//    }
//    public function validateElement(array &$element, FormStateInterface $form_state) {
//
//    }
//
//    public function validateForm(array &$form, FormStateInterface $form_state) {
//        $title = $form_state->getValue('what_is_your_name');
//        if (strlen($title) < 2) {
//            // Set an error for the form element with a key of "title".
//            $form_state->setErrorByName('what_is_your_name', $this->t('Your name is too short'));
//        }
//    }
//
//    /**
//     * {@inheritdoc}
//     */
//    public function submitForm(array &$form, FormStateInterface $form_state) {
//        // Display result.
//        foreach ($form_state->getValues() as $key => $value) {
//            drupal_set_message($key . ': ' . $value);
//        }
//
//    }
//
//}