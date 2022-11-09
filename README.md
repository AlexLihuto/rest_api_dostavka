
# Dostavka (rest api)

Test (junior). Good job!

What should the service include:

    API Methods
        Shipping Calculation Method
        Order Creation Method
        Order Information Retrieval Method
        Method for getting a list of orders
    The service must be able to interact with the client using the REST API or JSON RPC requests
    The service must implement RateLimit with a limit of 10 RPM

Additional Information:

    It is not necessary to implement logistics logic. At the discretion of the developer, 
    mock responses can be used. The goal is to develop an API service, not a full-fledged 
    courier delivery service.
    The service is being developed for “Intra-City Delivery”
    Code coverage with tests is welcome
    Availability of documentation describing the operation of the API service is welcome
    The use of data storage systems Redis, PostgreSQL, mongoDB is welcome

Task context:

In the process of working with the API, 3 main persons will be involved:

    Buyer. It is important for him to calculate the cost of delivery from the address of dispatch 
    to the address of receipt (at the same time, the address of dispatch is entered into the system 
    by the seller), for this he uses the "Calculation of delivery costs" method. After calculating 
    the cost, the buyer decides to place an order with delivery. When the user places an order, the 
    "Create Order" method is called. After that, the buyer waits for the delivery of his goods.
    
    Salesman. Should be able to see the entire list of orders placed by customers. For this, the 
    "Get a list of orders" method is available. It is also important for the seller to be able to 
    view the detailed information on the order in order to transfer the order to the courier for 
    delivery. For this, the method “Get order information” is available.
    
    Courier with mobile application. Should be able to view information about the order: what 
    product, where and when to deliver. To do this, the mobile application will call the 
    "Get Order Information" method.


## API Reference

### UserAuth

#### Register a User

```http
  POST /api/v1/register
```

Body Parameters

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `name` | `string` | **Required**. User name |
| `email` | `string` | **Required**. User email |
| `password` | `string` | **Required**. User password |
| `password_confirmation` | `string` | **Required**. User password confirmation |

#### Get a JWT token after successful login

```http
  POST /api/v1/login
```

Body Parameters

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `email`      | `string` | **Required**. User email |
| `password`      | `string` | **Required**. User password |

#### Get the Auth user using token

```http
  GET /api/v1/user
```

Authorization Parameters

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `token`      | `Bearer Token` | **Required**. Auth user JWT token |

#### Refresh a JWT token

```http
  GET /api/v1/refresh
```

Authorization Parameters

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `token`      | `Bearer Token` | **Required**. Auth user JWT token |

#### Logout user (Invalidate the token)

```http
  GET /api/v1/logout
```

Authorization Parameters

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `token`      | `Bearer Token` | **Required**. Auth user JWT token |

### Admin

#### Get all orders

```http
  GET /api/v1/admin/orders
```

Authorization Parameters

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `token`      | `Bearer Token` | **Required**. Auth user JWT token |

#### Get order by Id

```http
  GET /api/v1/admin/orders/{entityId}
```
Path Parameter

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `entityId`      | `int` | **Required**. Order Id |

Authorization Parameters

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `token`      | `Bearer Token` | **Required**. Auth user JWT token |

#### Create order

```http
  POST /api/v1/admin/orders
```

Authorization Parameters

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `token`      | `Bearer Token` | **Required**. Auth user JWT token |

Body Parameters

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `pointA` | `string` | **Required**. Starting point of delivery |
| `pointB` | `string` | **Required**. End point of delivery |
| `price` | `string` | **Required**. Сost of delivery |

#### Update order by Id

```http
  PUT /api/v1/admin/orders/{entityId}
```
Path Parameter

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `entityId`      | `int` | **Required**. Order Id |

Authorization Parameters

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `token`      | `Bearer Token` | **Required**. Auth user JWT token |

Body Parameters

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `pointA` | `string` | **Required**. Starting point of delivery |
| `pointB` | `string` | **Required**. End point of delivery |
| `price` | `string` | **Required**. Сost of delivery |

#### Delete order by Id

```http
  DELETE /api/v1/admin/orders/{entityId}
```
Path Parameter

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `entityId`      | `int` | **Required**. Order Id |

Authorization Parameters

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `token`      | `Bearer Token` | **Required**. Auth user JWT token |

### Buyer

#### Create order

```http
  POST /api/v1/buyer/orders
```

Authorization Parameters

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `token`      | `Bearer Token` | **Required**. Auth user JWT token |

Body Parameters

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `pointA` | `string` | **Required**. Starting point of delivery |
| `pointB` | `string` | **Required**. End point of delivery |
| `price` | `string` | **Required**. Сost of delivery |

### Seller

#### Get all orders

```http
  GET /api/v1/seller/orders
```

Authorization Parameters

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `token`      | `Bearer Token` | **Required**. Auth user JWT token |

#### Get order by Id

```http
  GET /api/v1/seller/orders/{entityId}
```
Path Parameter

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `entityId`      | `int` | **Required**. Order Id |

Authorization Parameters

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `token`      | `Bearer Token` | **Required**. Auth user JWT token |

### Courier

#### Get order by Id

```http
  GET /api/v1/courier/orders/{entityId}
```
Path Parameter

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `entityId`      | `int` | **Required**. Order Id |

Authorization Parameters

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `token`      | `Bearer Token` | **Required**. Auth user JWT token |
