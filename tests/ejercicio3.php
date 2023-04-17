POST http://localhost:8000/products
Content-Type: application/json
Accept: application/json

{
  "name": "Keyboard",
  "description": "Mechanical RGB Keyboard",
  "price": -200,
  "has_battery": true,
  "battery_duration": 8,
  "colors": [
    "blue",
    "white",
    "black"
  ],
  "dimensions": {
    "width": 40,
    "height": 5,
    "length": 20
  },
  "accessories": [
    {
      "name": "Wrist rest",
      "price": 20
    },
    {
      "name": "Keycaps",
      "price": 15
    }
  ]
}