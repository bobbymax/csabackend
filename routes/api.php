<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['cors', 'json.response']], function () {

    //Inventory custom routes
    Route::get('pending/requisitions', 'RequisitionController@getPendingRequisitions');
    Route::get('department/staff', 'StaffController@departmentStaff');
    Route::patch('alter/requisitions/{requisition}', 'RequisitionController@updateStatus');
    Route::get('approve/requisitions', 'RequisitionController@getRequisitionsForApproval');
    Route::get('handle/requisitions', 'RequisitionController@getProgressRequisitions');
    Route::patch('treat/requisitionItems/{requisitionItem}', 'RequisitionItemController@treatReq');
    Route::patch('update/status/requisitionItems/{requisitionItem}', 'RequisitionItemController@updateStatus');
    Route::get('operations', 'OperationController@operations');
    Route::get('fetch/tasks', 'TaskController@getTasks');
    Route::get('pending/reservations', 'LogisticsRequestController@getPendingReservations');
    Route::get('fetch/pending/schedules', 'BookingController@getPendingBookingRequests');

    // Helpdesk custom routes
    Route::patch('assign/tickets/{ticket}', 'TicketController@assign');
    Route::post('imports', 'OperationController@import');

    Route::post('staff/assign/tasks/{task}', 'TaskController@assign');

    Route::post('login', 'AuthController@login');
    Route::get('logout', 'AuthController@logout');
    Route::get('refresh', 'AuthController@refresh');
    Route::patch('status/logisticsRequests/{logisticsRequest}', 'LogisticsRequestController@updateLogisticsRequestStatus');

    Route::apiResource('remarks', 'RemarkController');
    Route::apiResource('companies', 'CompanyController');
    Route::apiResource('locations', 'LocationController');
    Route::apiResource('availabilities', 'AvailabilityController');
    Route::apiResource('staffTypes', 'StaffTypeController');
    Route::apiResource('gradeLevels', 'GradeLevelController');
    Route::apiResource('departmentTypes', 'DepartmentTypeController');
    Route::apiResource('departments', 'DepartmentController');
    Route::apiResource('users', 'StaffController');
    Route::apiResource('groups', 'GroupController');
    Route::apiResource('applications', 'ApplicationController');
    Route::apiResource('modules', 'ModuleController');
    Route::apiResource('permissions', 'PermissionController');
    Route::apiResource('floors', 'FloorController');

    // Inventory Routes
    Route::apiResource('inventoryCategories', 'InventoryCategoryController');
    Route::apiResource('stockCategories', 'StockCategoryController');
    Route::apiResource('stockTypes', 'StockTypeController');
    Route::apiResource('tags', 'TagController');
    Route::apiResource('stocks', 'StockController');
    Route::apiResource('items', 'ItemController');
    Route::apiResource('itemFeatures', 'ItemFeatureController');
    Route::apiResource('brands', 'BrandController');

    // Store Management Routes
    Route::apiResource('requisitions', 'RequisitionController');
    Route::apiResource('requisitionItems', 'RequisitionItemController');
    Route::apiResource('quotas', 'QuotaController');
    Route::apiResource('quotaItems', 'QuotaItemController');
    Route::apiResource('quotaDistributions', 'QuotaDistributionController');


    // Fleet Management Routes
    Route::apiResource('vehicleRequests', 'VehicleRequestController');
    Route::apiResource('itineraries', 'ItineraryController');
    Route::apiResource('repairCategories', 'RepairCategoryController');
    Route::apiResource('repairs', 'RepairController');
    Route::apiResource('vehicleRepairs', 'VehicleRepairController');

    // Logistics Request Routes
    Route::apiResource('logisticsRequests', 'LogisticsRequestController');
    Route::apiResource('reservations', 'ReservationController');
    Route::apiResource('consonances', 'ConsonanceController');


    // Helpdesk Routes
    Route::apiResource('incidentCategories', 'IncidentCategoryController');
    Route::apiResource('issues', 'IssueController');
    Route::apiResource('tickets', 'TicketController');

    // Facility Management Routes
    Route::apiResource('furnitureRequests', 'FurnitureRequestController');
    Route::apiResource('furnitureRequestItems', 'FurnitureRequestItemController');

    // Meeting Room Request Routes
    Route::apiResource('hallCategories', 'HallCategoryController');
    Route::apiResource('wings', 'WingController');
    Route::apiResource('rooms', 'RoomController');
    Route::apiResource('seatings', 'SeatingController');
    Route::apiResource('bookings', 'BookingController');
    Route::apiResource('bookingDetails', 'BookingDetailController');

    // Tasks Management Routes
    Route::apiResource('tasks', 'TaskController');
});
