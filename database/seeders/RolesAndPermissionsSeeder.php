<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Resetar permissões em cache
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Coleção de modelos para os quais vamos criar permissões
        $collection = collect([
            'AgenciasExternas',
            'PasseiosTuristicos',
            'Transportadora',
            'Organizadores',
            'Usuarios',
            'IngressoServico',   // Modelo IngressoServico
            'IngressoEspecial',
            'Categoria',  // Novo modelo IngressoEspecial adicionado
            'Ambulante', // Novo modelo IngressoEspecial adicionado
            'Local',  // Novo modelo IngressoEspecial adicionado
        ]);

        // Criar permissões para cada item da coleção
        $collection->each(function ($item) {
            // Criar permissões para visualização, criação, atualização, exclusão
            $permissions = [
                'viewAny'.$item,  // Visualizar lista
                'view'.$item,     // Visualizar item específico
                'create'.$item,   // Criar novo item
                'update'.$item,   // Editar item
                'delete'.$item,   // Deletar item
            ];

            // Verificar se a permissão já existe antes de criá-la
            foreach ($permissions as $permissionName) {
                if (! Permission::where('name', $permissionName)->exists()) {
                    Permission::create(['group' => $item, 'name' => $permissionName]);
                }
            }
        });

        // Criar a função super-admin e atribuir todas as permissões
        $superAdminRole = Role::firstOrCreate(['name' => 'super-admin']);
        $superAdminRole->syncPermissions(Permission::all());

        // Criar a função guarda (visualização limitada)
        $limitedViewRole = Role::firstOrCreate(['name' => 'guarda']);
        $limitedPermissions = Permission::whereIn('name', [
            'viewAnyAgenciasExternas', 'viewAgenciasExternas',
            'viewAnyPasseiosTuristicos', 'viewPasseiosTuristicos',
            'viewAnyIngressoServico', 'viewIngressoServico',
            'viewAnyIngressoEspecial', 'viewIngressoEspecial', // Nova permissão de visualização para IngressoEspecial
        ])->get();
        $limitedViewRole->syncPermissions($limitedPermissions);

        $LocalViewRole = Role::firstOrCreate(['name' => 'Ambulante']);
        $LocalPermissions = Permission::whereIn('name', [
            'viewAnyLocal', 'viewLocal',
            'viewAnyCategoria', 'viewCategoria',
            'viewAnyAmbulante', 'viewAmbulante',
            // Nova permissão de visualização para IngressoEspecial
        ])->get();
        $LocalViewRole->syncPermissions($LocalPermissions);

        $LocalViewRole = Role::firstOrCreate(['name' => 'admin_Ambulante']);
        $LocalPermissions = Permission::whereIn('name', [
            'viewAnyLocal', 'viewLocal',
            'createLocal', 'updateLocal', 'deleteLocal',

            // Novas permissões para o modelo Categoria
            'viewAnyCategoria', 'viewCategoria',
            'createCategoria', 'updateCategoria', 'deleteCategoria',

            // Novas permissões para o modelo Ambulante
            'viewAnyAmbulante', 'viewAmbulante',
            'createAmbulante', 'updateAmbulante', 'deleteAmbulante',
            // Nova permissão de visualização para IngressoEspecial
        ])->get();
        $LocalViewRole->syncPermissions($LocalPermissions);

        // Criar a função admin com permissões completas
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        // Atribuindo permissões de visualização, criação, atualização e exclusão
        $adminPermissions = Permission::whereIn('name', [
            'viewAnyAgenciasExternas', 'viewAgenciasExternas',
            'createAgenciasExternas', 'updateAgenciasExternas', 'deleteAgenciasExternas',
            'viewAnyPasseiosTuristicos', 'viewPasseiosTuristicos',
            'createPasseiosTuristicos', 'updatePasseiosTuristicos', 'deletePasseiosTuristicos',
            'viewAnyTransportadora', 'viewTransportadora',
            'createTransportadora', 'updateTransportadora', 'deleteTransportadora',
            'viewAnyOrganizadores', 'viewOrganizadores',
            'createOrganizadores', 'updateOrganizadores', 'deleteOrganizadores',
            'viewAnyUsuarios', 'viewUsuarios',
            'createUsuarios', 'updateUsuarios', 'deleteUsuarios',
            // Permissões para o modelo IngressoServico
            'viewAnyIngressoServico', 'viewIngressoServico',
            'createIngressoServico', 'updateIngressoServico', 'deleteIngressoServico',
            // Permissões para o modelo IngressoEspecial
            'viewAnyIngressoEspecial', 'viewIngressoEspecial',
            'createIngressoEspecial', 'updateIngressoEspecial', 'deleteIngressoEspecial',
        ])->get();

        // Atribuir permissões ao admin
        $adminRole->syncPermissions($adminPermissions);

        // Atribuir role de super-admin a um usuário específico
        $user = User::where('email', 'leonardocbalb@gmail.com')->first();
        if ($user) {
            $user->assignRole('super-admin');
        } else {
            // Log para caso o usuário não seja encontrado
            Log::info('Usuário com e-mail leonardocbalb@gmail.com não encontrado.');
        }

        // Atribuir role 'admin' a outro usuário (exemplo)
        $adminUser = User::where('email', 'admin@passeios.com')->first(); // Alterar para o e-mail do admin
        if ($adminUser) {
            $adminUser->assignRole('admin');
        } else {
            // Log para caso o usuário não seja encontrado
            Log::info('Usuário com e-mail admin@passeios.com não encontrado.');
        }
    }
}
