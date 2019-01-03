<?php
/**
 *@SWG\Swagger(
 *     schemes={"http"},   
 *     @SWG\Info(
 *         version="1.0",
 *         title="Backend Boilerplate",
 *     ),
 *     @SWG\Definition(
 *          definition="Role Response",
 * 			title="Role",
 * 			@SWG\Property(property="id", type="integer", description="UUID"),
 * 			@SWG\Property(property="name", type="string"),
 * 			@SWG\Property(property="guard_name", type="string"),
 *          @SWG\Property(property="created_at", type="string"),
 *          @SWG\Property(property="updated_at", type="string")
 * 		),
 *      @SWG\Definition(
 *          definition="Role",
 * 			title="Role Request",
 *          required={"name", "guard_name"},
 * 			@SWG\Property(property="name", type="string"),
 * 			@SWG\Property(property="guard_name", type="string"),
 * 		)
 * )
 * 
 * @SWG\SecurityScheme(
 *     securityDefinition="passport",
 *     type="oauth2",
 *     tokenUrl="/oauth/token",
 *     flow="password",
 *     scopes={}
 * )
 * 
 * @SWG\Post(
 *     path="/register",
 *     summary="Register user",
 *     tags={"user"},
 *     @SWG\Parameter(
 *          name="body",
 *          in="body",
 *          required=true,
 *          @SWG\Schema(
 *              title="User",
 *              type="object",
 *              @SWG\Property(property="first_name", type="string"),
 *              @SWG\Property(property="last_name", type="string"),
 *              @SWG\Property(property="username", type="string"),
 *              @SWG\Property(property="email", type="string"),
 *              @SWG\Property(property="role", type="integer"),
 *          ),
 *     ),
 *     @SWG\Response(
 *          response=200,
 *          description="success",
 *          @SWG\Schema(ref="#/definitions/User"),
 *     ),
 *     @SWG\Response(
 *         response=422,
 *         description="error details",
 *     ),
 *     security={{"Bearer":{}}}
 * )
 *
 * @SWG\Get(
 *     path="/api/profile",
 *     tags={"user"},
 *     summary="User's Profile",
 *     @SWG\Response(
 *          response=200,
 *          description="success",
 *          @SWG\Schema(ref="#/definitions/User"),
 *     ),
 *     @SWG\Response(
 *          response=422,
 *          description="error details",
 *
 *     ),
 *     security={{"Bearer":{}}}
 * )
 * 
 * @SWG\Get(
 *     path="/logout",
 *     tags={"user"},
 *     summary="Logout",
 *      @SWG\Response(
 *          response=200,
 *          description="success",
 *
 *     ),
 *     @SWG\Response(
 *          response=422,
 *          description="Unprocessable Entity",
 *
 *     ),
 *     security={{"Bearer":{}}}
 * )
 * 
 * *  @SWG\GET(
 *     path="/api/roles",
 *     tags={"roles"},
 *     summary="Get all roles",
 *     produces={"application/json"},
 *   
 *     @SWG\Response(
 *          response=200,
 *          description="data",
 *          @SWG\Schema(ref="#/definitions/Role Response")

 *     ),
 *     @SWG\Response(
 *          response=422,
 *          description="error details",
 *
 *     ),
 *     security={{"Bearer":{}}},
 *)


 *  @SWG\Post(
 *     path="/api/roles/{id}",
 *     tags={"roles"},
 *     summary="Create new role",
 *     produces={"application/json"},
 *     @SWG\Parameter(
 *          name="body",
 *          in="body",
 *          required=true,
 *          @SWG\Schema(ref="#/definitions/Role")
 *     ),
 *     @SWG\Response(
 *          response=200,
 *          description="data",
 *          @SWG\Schema(ref="#/definitions/Role Response")

 *     ),
 *     @SWG\Response(
 *          response=422,
 *          description="error details",
 *
 *     ),
 *     security={{"Bearer":{}}},
 *)

 *  @SWG\PUT(
 *     path="/api/roles/{id}",
 *     tags={"roles"},
 *     summary="Update a role",
 *     @SWG\Parameter(
 *          name="body",
 *          in="body",
 *          required=true,
 *          @SWG\Schema(ref="#/definitions/Role")
 *     ),
 *     @SWG\Response(
 *          response=200,
 *          description="data",
 *          @SWG\Schema(ref="#/definitions/Role Response")
 *     ),
 *     @SWG\Response(
 *          response=422,
 *          description="error details",
 *
 *     ),
 *     security={{"Bearer":{}}}
 * )
 *
 *  @SWG\DELETE(
 *     path="/api/roles/{id}",
 *     tags={"roles"},
 *     summary="Delete a role",
 *     @SWG\Response(
 *          response=200,
 *          description="data",
 *          @SWG\Schema(ref="#/definitions/Role Response")
 *     ),
 *     @SWG\Response(
 *          response=422,
 *          description="error details",
 *
 *     ),
 *     security={{"Bearer":{}}}
 * )
 *
*/