<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:read messages')->only(['index']);
        $this->middleware('can:create messages')->only(['create', 'store']);
        $this->middleware('can:update messages')->only(['edit', 'update']);
        $this->middleware('can:delete messages')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::paginate(10);
        return view('admin.messages.index', compact('contacts'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return response()->json(['message' => 'Deleted successfully'], 200);
    }
}