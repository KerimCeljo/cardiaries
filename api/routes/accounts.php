<?php
/* Swagger documentation */

/**
 * @OA\Info(title="CarDiaries API", version="0.1")
 *  @OA\OpenApi(
 *      @OA\Server(url="http://localhost/cardiaries/api/", description="Development Environment" ),
 *      @OA\Server(url="https://cardiaries.ahmed.games/api/", description="Production Environment" )
 * ),
 *  @OA\SecurityScheme(
 *      securityScheme="ApiKeyAuth",
 *      in="header",
 *      name="Authentication",
 *      type="apiKey"
 * )
 */

/**
 * @OA\Get(path="/accounts", tags={"account"}, security={{"ApiKeyAuth": {}}},
 *    @OA\Parameter(type="integer", in="query", name="offset", default=0, description="Offset for pagination"),
 *    @OA\Parameter(type="integer", in="query", name="limit", default=25, description="Limit for pagination"),
 *    @OA\Parameter(type="string", in="query", name="search", description="Search string for accounts. Case insensitive search"),
 *    @OA\Parameter(type="string", in="query", name="order", default="-id", description="Sorting for return elements.        -column_name ascending order or +column_name for desceding order by column_name"),
 *    @OA\Response(response="200", description="List accounts from database")
 * )
 */
Flight::route('GET /accounts', function () {
    $offset = Flight::query('offset', 0);
    $limit = Flight::query('limit', 10);
    $search = Flight::query('search', '');
    $order = Flight::query('order', "-id");
    Flight::json(Flight::accountService()->get_accounts($search, $offset, $limit, $order));
});

/**
 * @OA\Get(path="/accounts/{id}", tags={"account"}, security={{"ApiKeyAuth": {}}},
 *    @OA\Parameter(type="integer", in="path", name="id", default=1, description="ID of acccount"),
 *    @OA\Response(response="200", description="Fetch individual account")
 * )
 */
Flight::route('GET /accounts/@id', function ($id) {
    // if (Flight::get('user')['aid'] != $id) throw new Exception("This account is not for you!", 403);
    Flight::json(Flight::accountService()->get_by_id($id));
});

/**
 * 
 * @OA\Post(path="/accounts", tags={"account"}, security={{"ApiKeyAuth": {}}},
 *      @OA\RequestBody(
 *          description="Basic accont inforamtion!",
 *          required=true,
 *          @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				@OA\Property(property="name", required="true", type="string", example="My Test Account", description="Account name"),
 *    				@OA\Property(property="status", type="string", example="ACTIVE", description="Status of the account") 
 *                   
 *              )
 *          )
 *      ),
 *      @OA\Response(response="200", description="Account that has been added to the database with ID assigned")
 * )
 * 
 */
Flight::route('POST /accounts', function () {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::accountService()->add($data));
});

/**
 * @OA\Put(path="/accounts/{id}", tags={"account"}, security={{"ApiKeyAuth": {}}},
 *    @OA\Parameter(@OA\Schema(type="integer"), in="path", name="id", default=1),
 *    @OA\RequestBody(
 *          description="Basic accont inforamtion that's going to be updated!",
 *          required=true,
 *          @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				@OA\Property(property="name", required="true", type="string", example="My Test Account", description="Account name"),
 *    				@OA\Property(property="status", type="string", example="ACTIVE", description="Status of the account") 
 *                   
 *              )
 *          )
 *      ),
 *    @OA\Response(response="200", description="Update account based on id")
 * )
 */
//Route to update account table
Flight::route('PUT /accounts/@id', function ($id) {
    $data = Flight::request()->data->getData();

    Flight::json(Flight::accountService()->update($id, $data));
});
