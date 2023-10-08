<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class rolesPermisos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Creacion Rol Seguridad
        $rol_seguridad=Role::create(['name'=>"seguridad"]);      

        //Creacion Rol Gerencia
        $rol_gerencia=Role::create(['name'=>"gerencia"]);

        //Creacion Permiso Universal CRUD Trabajadores
        $permiso_CRUD_trabajadores=Permission::create(['name'=>"trabajadores"]);

        //Creacion Permiso Universal CRUD Areas
        $permiso_CRUD_areas=Permission::create(['name'=>"areas"]);

        //Creacion Permiso Universal CRUD Equipos
        $permiso_CRUD_equipos=Permission::create(['name'=>"equipos"]);

        //Creacion Permiso Universal CRUD Equipos
        $permiso_CRUD_visitantes=Permission::create(['name'=>"visitantes"]);

        //Creacion Permiso Universal CRUD Visitas
        $permiso_CRUD_visitas=Permission::create(['name'=>"visitas"]);

        //Asigancion Permiso trabajadores al Rol Gerencia
        $permiso_CRUD_trabajadores->syncRoles($rol_gerencia);

        //Asigancion Permiso areas al Rol Gerencia
        $permiso_CRUD_areas->syncRoles($rol_gerencia);

        //Asigancion Equipos areas al Rol Seguridad
        $permiso_CRUD_equipos->syncRoles($rol_seguridad);

        //Asigancion visitantes areas al Rol Seguridad
        $permiso_CRUD_visitantes->syncRoles($rol_seguridad);

        //Asigancion visitas areas al Rol Seguridad
        $permiso_CRUD_visitas->syncRoles($rol_seguridad);

    }
}
