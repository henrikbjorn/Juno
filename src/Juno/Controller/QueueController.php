<?php

namespace Juno\Controller;

/**
 * @package Juno
 */
class QueueController extends \Flint\Controller\Controller
{
    /**
     * @return string
     */
    public function indexAction()
    {
        return $this->render('Queue/index.html.twig', array(
            'queues' => $this->app['raekke.queue_manager'],
        ));
    }

    /**
     * @param string $queue
     * @return string
     */
    public function showAction($queue)
    {
        $queues = $this->app['raekke.queue_manager'];

        if (!$queues->has($queue)) {
            return $this->app->abort(404, 'Queue "' . $queue . '" does not exits.');
        }

        return $this->render('Queue/show.html.twig', array(
            'queue' => $queues->get($queue),
        ));
    }

    /**
     * @param string $queue
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteAction($queue)
    {
        $queues = $this->app['raekke.queue_manager'];
        $queues->remove($queue);

        return $this->redirect($this->app['router']->generate('queue_index'));
    }
}
