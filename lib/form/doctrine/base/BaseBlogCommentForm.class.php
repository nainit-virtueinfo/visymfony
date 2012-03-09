<?php

/**
 * BlogComment form base class.
 *
 * @method BlogComment getObject() Returns the current form's model object
 *
 * @package    doctrine
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseBlogCommentForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'blog_article_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('BlogArticle'), 'add_empty' => true)),
      'author'          => new sfWidgetFormInputText(),
      'content'         => new sfWidgetFormTextarea(),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'blog_article_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('BlogArticle'), 'required' => false)),
      'author'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'content'         => new sfValidatorString(array('required' => false)),
      'created_at'      => new sfValidatorDateTime(),
      'updated_at'      => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('blog_comment[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'BlogComment';
  }

}
