<?php
namespace Curso\News\Block\Adminhtml;

class Allnews extends \Magento\Backend\Block\Widget\Grid\Container
{
    protected function _construct()
    {
        $this->_controller = 'adminhtml_allnews';
        $this->_blockGroup = 'Curso_News';
        $this->_headerText = __('Manage News');

        parent::_construct();

        if ($this->_isAllowedAction('Curso_News::save')) {
            $this->buttonList->update('add', 'label', __('Add News'));
        } else {
            $this->buttonList->remove('add');
        }
    }
    /**
     * @param [type] $resourceId
     * @return void
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}
