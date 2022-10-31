#### INSTALLATION:

```shell
git clone git@github.com:evgeny89/telecom.git

cd telecom

composer install

./vendor/bin/sail up
```

   * Open ```localhost``` in browser :)

   * Use postman

#### USE:

##### Equipment Type:
1. Route: ```localhost/api/equipment_type/```

   method ```get``` (list)

   payload (querystring): 
   * q: ```localhost/api/equipment_type?q=300``` search in name and mask column
   * name: ```localhost/api/equipment_type?name=D-Link``` search in name column
   * mask: ```localhost/api/equipment_type?name=NXXAAXZXaa``` search in mask column
   * page: ```localhost/api/equipment_type?page=1``` pagination

   method ```post``` (create)

   payload (body):
   * ```name``` - string
   * ```mask``` - string

2. Route: ```localhost/api/equipment_type/{id}``` (int)

   method ```put``` (update)

   payload (body):
   * ```name``` - string
   * ```mask``` - string

   method ```delete``` (delete)

   payload (none):

3. Route: ```localhost/api/equipment/```
   method ```get``` (list)

   payload (querystring):
    * q: ```localhost/api/equipment?q=300``` search in serial number, description and type name
    * serial number: ```localhost/api/equipment?sn=Wxx``` search in equipment serial number column
    * description: ```localhost/api/equipment?desc=office``` search in equipment description column
    * type: ```localhost/api/equipment?type=D-Link``` search in equipment type name column
    * page: ```localhost/api/equipment?page=1``` pagination

   method ```post``` (create)

   payload (body):
    * ```equipments``` - array
    * ```equipments.equipment_type_id``` - int
    * ```equipments.serial_number``` - string
    * ```equipments.description``` - string

4. Route: ```localhost/api/equipment/{id}``` (int)

   method ```put``` (update)

   payload (body):
    * ```equipment_type_id``` - int
    * ```serial_number``` - string
    * ```description``` - string

   method ```delete``` (delete)

   payload (none):
