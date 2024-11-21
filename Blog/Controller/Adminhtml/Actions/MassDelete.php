<?php

declare (strict_types=1);

namespace Convert\Blog\Controller\Adminhtml\Actions;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\Controller\ResultFactory;
use Convert\Blog\Model\ResourceModel\Collection;

/**
 * Class MassDelete
 */
class MassDelete extends Action
{
    const ID_FIELD = 'id';
    const REDIRECT_URL = 'blog/post/index';
    protected string $collection = 'Convert\Blog\Model\ResourceModel\Collection';

    /**
     * @return Redirect
     */

    public function execute(): Redirect
    {
        $selected = $this->getRequest()->getParam('selected');
        $excluded = $this->getRequest()->getParam('excluded');
        $collection = $this->_objectManager->create($this->collection);
        try {
            if (!empty($excluded)) {
                $collection->addFieldToFilter(static::ID_FIELD, ['nin' => $excluded]);
                $this->massAction($collection);
            } elseif (!empty($selected)) {
                $collection->addFieldToFilter(static::ID_FIELD, ['in' => $selected]);
                $this->massAction($collection);
            } else {
                $this->messageManager->addError(__('Please select product(s).'));
            }
        } catch (\Exception $e) {
            $this->messageManager->addError($e->getMessage());
        }
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath(static::REDIRECT_URL);
    }

    /**
     * Cancel selected orders
     *
     * @param Collection $collection
     * @return void
     */
    protected function massAction(Collection $collection): void
    {
        $count = 0;
        foreach ($collection->getItems() as $list) {
            $list->delete();
            ++$count;
        }
        $this->messageManager->addSuccess(__('A total of %1 record(s) have been deleted.', $count));
    }

}
