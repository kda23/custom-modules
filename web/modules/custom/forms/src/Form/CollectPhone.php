<?php
/**
 * @file
 * Contains \Drupal\helloworld\Form\CollectPhone.
 *
 * В комментарии выше указываем, что содержится в данном файле.
 */

// Объявляем пространство имён формы. Drupal\НАЗВАНИЕ_МОДУЛЯ\Form
namespace Drupal\forms\Form;

// Указываем что нам потребуется FormBase, от которого мы будем наследоваться
// а также FormStateInterface который позволит работать с данными.
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Объявляем нашу форму, наследуясь от FormBase.
 * Название класса строго должно соответствовать названию файла.
 */
class CollectPhone extends FormBase {

    /**
     * То что ниже - это аннотация. Аннотации пишутся в комментариях и в них
     * объявляются различные данные. В данном случае указано, что документацию
     * к данному методу надо взять из комментария к самому классу.
     *
     * А в самом методе мы возвращаем название нашей формы в виде строки.
     * Эта строка используется для альтера формы (об этом ниже в тексте).
     *
     * {@inheritdoc}.
     */
    public function getFormId() {
        return 'profession';
    }

    /**
     * Создание нашей формы.
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
        );
        $form['profession'] = array(
            '#type' => 'radios',
            '#title' => $this->t('profession'),
            '#options' => array('Student'=>t('Student'),'Engineer'=>t('Engineer'),'Doctor'=>t('Doctor')),
        );
        $form['clear'] = array(
            '#type' => 'button',
            '#value' => t('Clear'),
            '#attributes' => array('onclick' => 'this.form.reset(); return false;'),
        );
        $form['restore'] = array(

        );
        // Предоставляет обёртку для одного или более Action элементов.
        $form['actions']['#type'] = 'actions';
        // Добавляем нашу кнопку для отправки.
        $form['actions']['submit']['#ajax'] = [
            'wrapper' => 'asjhdjkajksjhasd',
            'callback' => array($this, 'ajaxRebuildCallback'),
            'effect' => 'fade',
        ];
        $form['actions']['submit'] = array(
            '#type' => 'submit',
            '#value' => $this->t('Send name and phone'),
            '#button_type' => 'primary',
        );
        return $form;
    }

    /**
     * Validation of sent data in the form.
     *
     * {@inheritdoc}
     */
    public function validateForm(array &$form, FormStateInterface $form_state) {
        // Если длина имени меньше 5, выводим ошибку.
        if (strlen($form_state->getValue('name')) < 2) {
            $form_state->setErrorByName('name', $this->t('Name is too short.'));
        }
        if (strlen($form_state->getValue('surname')) < 2) {
            $form_state->setErrorByName('surname', $this->t('Surname is too short.'));
        }
        if ($form_state->getValue('age') < 18) {
            $form_state->setErrorByName('age', $this->t('You Must Be 18 or Older to Register'));
        }
    }

    /**
     * Form submit .
     *
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
        // Мы ничего не хотим делать с данными, просто выведем их в системном
        // сообщении.
        drupal_set_message($this->t('Thank you @name, your phone number is @number', array(
            '@name' => $form_state->getValue('name'),
            '@number' => $form_state->getValue('phone_number')
        )));
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