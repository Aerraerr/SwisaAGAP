<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq; // ✅ Import the Faq model

class FaqsController extends Controller
{
    /**
     * Display all FAQs grouped by audience.
     */
    public function index()
    {
        $userFaqs = Faq::where('target_audience', 'user')->get();
        $adminFaqs = Faq::where('target_audience', 'admin')->get();
        $supportFaqs = Faq::where('target_audience', 'support-staff')->get();

        return view('swisa-admin.faqs', compact('userFaqs', 'adminFaqs', 'supportFaqs'));
    }

    /**
     * Show create FAQ form (Admin only).
     */
    public function create()
    {
        return view('faqs.create');
    }

    /**
     * Store new FAQ in DB.
     */
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'target_audience' => 'required|in:user,admin,support-staff', // fixed 'support-support'
            'type' => 'required|string',
        ]);

        Faq::create($request->all());

        return redirect()->route('faqs.index')->with('success', 'FAQ created successfully.');

    }

    /**
     * Show edit FAQ form.
     */
    public function edit(Faq $faq)
    {
        return view('faqs.edit', compact('faq'));
    }

    /**
     * Update FAQ in DB.
     */
    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer'   => 'required|string',
            'target_audience' => 'required|in:user,admin,support-staff',
        ]);

        $faq->update($request->all());

        return redirect()->route('faqs.index')->with('success', 'FAQ updated successfully.');
    }

    /**
     * Delete FAQ.
     */
    public function destroy($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();

        return redirect()->back()->with('success', 'FAQ deleted successfully.');
    }

}
