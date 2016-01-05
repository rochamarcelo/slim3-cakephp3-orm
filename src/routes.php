<?php
// Routes

$app->get('/[{name}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});
// Routes
$app->get('/api/animes', function($request, $response) {
    $body = $response->getBody();
    $animes = $this->AnimesTable->find()->order([
        'name' => 'ASC'
    ])->all();

    $body->write(json_encode($animes));
    return $response;
});

$app->get('/api/animes/{id}', function($request, $response, $args) {
    $anime = $this->AnimesTable->get((int)$args['id']);
    $body = $response->getBody();
    $body->write(json_encode($anime));
    return $response;
});

$app->post('/api/animes', function($request, $response) {
    $data = (array)$request->getParsedBody();

    $entity = $this->AnimesTable->newEntity($data);
    $result = $this->AnimesTable->save($entity);
    if ( $entity->errors() ) {
        $newResponse = $response->withStatus(400);
        $body = $newResponse->getBody();
        $result = [
            'code' => 400,
            'message' => 'Validation error',
            'errors' => $entity->errors()
        ];
        $body->write(json_encode($result));
        return $newResponse;
    }

    $body = $response->getBody();
    $body->write(json_encode($entity));
    return $response;
});

$app->put('/api/animes/{id}', function($request, $response, $args) {
    $data = (array)$request->getParsedBody();

    $entity = $this->AnimesTable->get((int)$args['id']);
    $this->AnimesTable->patchEntity($entity, $data);
    $result = $this->AnimesTable->save($entity);
    if ( $entity->errors()) {
        $newResponse = $response->withStatus(400);
        $body = $newResponse->getBody();
        $result = [
            'code' => 400,
            'message' => 'Validation error',
            'errors' => $entity->errors()
        ];
        $body->write(json_encode($result));
        return $newResponse;
    }

    $body = $response->getBody();
    $body->write(json_encode($result));
    return $response;
});

$app->delete('/api/animes/{id}', function($request, $response, $args) {
    $body = $response->getBody();
    $entity = $this->AnimesTable->get((int)$args['id']);
    $result = $this->AnimesTable->delete($entity);

    $body->write(json_encode([]));
    return $response;
});