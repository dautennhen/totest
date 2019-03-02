<?php

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // set group user
        $group_admin = factory(App\Models\Group::class)->create([
            'name' => 'admin',
            'description' => 'We are admin page.',
        ]);

        $group_pool_owner = factory(App\Models\Group::class)->create([
            'name' => 'pool-owner',
            'description' => 'We are pool owner.',
        ]);

        $group_service_company = factory(App\Models\Group::class)->create([
            'name' => 'service-company',
            'description' => 'We are service_company page.',
        ]);

        $group_technician = factory(App\Models\Group::class)->create([
            'name' => 'technician',
            'description' => 'We are technician page.',
        ]);

        // set permission
        $permission_admin_manager = factory(App\Models\Permission::class)->create([
            'name' => 'zipcode edit',
            'alias' => 'zipcode-edit',            
        ]);

        $permission_admin_option = factory(App\Models\Permission::class)->create([
            'name' => 'zipcode list',
            'alias' => 'zipcode-list',            
        ]);

        $permission_admin_option_contact = factory(App\Models\Permission::class)->create([
            'name' => 'zipcode new',
            'alias' => 'zipcode-new',            
        ]);

        $permission_admin_page = factory(App\Models\Permission::class)->create([
            'name' => 'zipcode-remove',
            'alias' => 'zipcode-remove',            
        ]);

        $permission_admin_administrator = factory(App\Models\Permission::class)->create([
            'name' => 'zipcode-save',
            'alias' => 'zipcode-save',            
        ]);

        $permission_ajax_upload_file = factory(App\Models\Permission::class)->create([
            'name' => 'ajax-upload-file',
            'alias' => 'ajax-upload-file',            
        ]);
        
        $permission_ajax_upload_img = factory(App\Models\Permission::class)->create([
            'name' => 'ajax-upload-image',
            'alias' => 'ajax-upload-image',            
        ]);
        
        // set new user admin
        $user_admin = factory(App\Models\User::class)->create([
            'name' => 'Admin',
            //'status' => 'active',
            'email' => 'admin@rowboatsoftware.com',            
        ]);

        // set new user user_pool
        $user_pool = factory(App\Models\User::class)->create([
            'name' => 'Pool',
            //'status' => 'active',            
            'email' => 'pool@rowboatsoftware.com',            
        ]);

        /* factory(App\Models\BillingInfo::class)->create([
            'user_id' => $user_pool->id
        ]);
        $pool_profile =factory(App\Models\Profile::class)->create([
            'user_id' => $user_pool->id
        ]);
          
         
        factory(App\Models\Poolowner::class)->create([
            'user_id' => $user_pool->id
        ]);
        factory(App\Models\Order::class)->create([
            'poolowner_id' => $user_pool->id,
            'zipcode' =>[$pool_profile->zipcode]
        ]);
       */

        // set new user user_company
        $user_company = factory(App\Models\User::class)->create([
            'name' => 'Company',
            //'status' => 'active',            
            'email' => 'company@rowboatsoftware.com'          
        ]);
        /*
        factory(App\Models\BillingInfo::class)->create([
            'user_id' => $user_company->id
        ]);
        factory(App\Models\Profile::class)->create([
            'user_id' => $user_company->id
        ]);
*/
        // set new user user_technician
        $user_technician = factory(App\Models\User::class)->create([
            'name' => 'Technician',
            //'status' => 'active',            
            'email' => 'technician@rowboatsoftware.com',            
        ]);
  /*      factory(App\Models\BillingInfo::class)->create([
            'user_id' => $user_technician->id
        ]);
        factory(App\Models\Profile::class)->create([
            'user_id' => $user_technician->id
        ]);
*/
         // list user poolowner
        $user_pools = factory(App\Models\User::class, 30)->create([
            //'status' => 'active',   
        ]);
  /*      
        foreach($user_pools as $user_pool_new){
            factory(App\Models\Poolowner::class)->create([
                'user_id' => $user_pool_new->id
            ]);
            factory(App\Models\Order::class)->create([
                'poolowner_id' => $user_pool_new->id
            ]);
            factory(App\Models\BillingInfo::class)->create([
                'user_id' => $user_pool_new->id
            ]);
            factory(App\Models\Profile::class)->create([
                'user_id' => $user_pool_new->id
            ]);
        }
*/

  /*      $group_admin->permissions()->attach($permission_admin_manager->id);
        $group_admin->permissions()->attach($permission_admin_option->id);
        $group_admin->permissions()->attach($permission_admin_option_contact->id);
        $group_admin->permissions()->attach( $permission_admin_page->id);
        $group_admin->permissions()->attach( $permission_admin_administrator->id);
*/
        $group_admin->users()->attach( $user_admin->id);
        $group_pool_owner->users()->attach( $user_pool ->id);
        $group_service_company->users()->attach( $user_company->id);
        $group_technician->users()->attach( $user_technician->id);
        
        // allow upload 
        $group_service_company->permissions()->attach($permission_ajax_upload_img->id);
        $group_service_company->permissions()->attach($permission_ajax_upload_file->id);

        
        $arr = [
            'poolowner' => [
                'pool-owner',
                'dashboard-poolowner-save-email',
                'dashboard-poolowner-save-password',
                'dashboard-poolowner-save-profile',
                'dashboard-poolowner-save-poolinfo'
            ],
            'company' => [
                'service-company',
                'dashboard-company-change-services-offer'
            ],
            'techician'=>[
                'technician',
                'dashboard-company-list-technician',
                'dashboard-company-save-technician',
                'dashboard-company-remove-technician'
            ]
        ];

        foreach($arr as $group => $ps){
            foreach($ps as $k => $p){
                $pms = factory(App\Models\Permission::class)->create([
                    'name' => $p,
                    'alias' => $p
                ]);
                switch($group) {
                    case 'poolowner':
                        $group_pool_owner->permissions()->attach($pms);
                        break;
                    case 'company':
                        $group_service_company->permissions()->attach($pms);
                        break;
                    case '':
                        $group_technician->permissions()->attach($pms);
                        break;
                }
            }
        }
    }
}