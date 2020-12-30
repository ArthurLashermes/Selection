<?php

namespace Selection\Controller;

use Thelia\Controller\Admin\BaseAdminController;
use Thelia\Core\Event\UpdatePositionEvent;

class SelectionController extends BaseAdminController
{
    /**
     * Show the default template : selectionList
     *
     * @return \Thelia\Core\HttpFoundation\Response
     */
    public function viewAction()
    {
        return $this->render(
            "selection-list",
            [
                'selection_order' => $this->getAttributeSelectionOrder(),
                'selection_container_order' => $this->getAttributeContainerOrder()
            ]
        );
    }

    private function getAttributeSelectionOrder()
    {
        return $this->getListOrderFromSession(
            'selection',
            'selection_order',
            'manual'
        );
    }

    private function getAttributeContainerOrder()
    {
        return $this->getListOrderFromSession(
            'selectioncontainer',
            'selection_container_order',
            'manual'
        );
    }

    protected function createUpdatePositionEvent($positionChangeMode, $positionValue)
    {
        return new UpdatePositionEvent(
            $this->getRequest()->get('selection_id', null),
            $positionChangeMode,
            $positionValue
        );
    }
}
