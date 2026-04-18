@extends('admin.layout')

@section('content')
    <div class="admin-header">
        <h1>Dashboard</h1>
    </div>

    <div class="card">
        <h2>Welcome to NightLight Admin Dashboard</h2>
        <p>Manage your website content from here. Use the sidebar to navigate to different sections.</p>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-top: 2rem;">
            <div style="background: #46305e; color: #ffffff; padding: 2rem; border-radius: 8px; text-align: center;">
                <h3 style="margin: 0 0 1rem 0; color: #ffffff;">Announcement</h3>
                <p style="margin: 0; color: rgba(255,255,255,0.8);">Manage announcement content</p>
                <a href="{{ route('admin.announcement') }}" style="display: inline-block; margin-top: 1rem; padding: 0.5rem 1rem; background: #ffffff; color: #46305e; text-decoration: none; border-radius: 5px;">Manage</a>
            </div>
            
            <div style="background: #46305e; color: #ffffff; padding: 2rem; border-radius: 8px; text-align: center;">
                <h3 style="margin: 0 0 1rem 0; color: #ffffff;">Gallery</h3>
                <p style="margin: 0; color: rgba(255,255,255,0.8);">Manage gallery images</p>
                <a href="{{ route('admin.gallery') }}" style="display: inline-block; margin-top: 1rem; padding: 0.5rem 1rem; background: #ffffff; color: #46305e; text-decoration: none; border-radius: 5px;">Manage</a>
            </div>
            
            <div style="background: #46305e; color: #ffffff; padding: 2rem; border-radius: 8px; text-align: center;">
                <h3 style="margin: 0 0 1rem 0; color: #ffffff;">Team</h3>
                <p style="margin: 0; color: rgba(255,255,255,0.8);">Manage team members</p>
                <a href="{{ route('admin.team') }}" style="display: inline-block; margin-top: 1rem; padding: 0.5rem 1rem; background: #ffffff; color: #46305e; text-decoration: none; border-radius: 5px;">Manage</a>
            </div>
            
            <div style="background: #46305e; color: #ffffff; padding: 2rem; border-radius: 8px; text-align: center;">
                <h3 style="margin: 0 0 1rem 0; color: #ffffff;">Footer</h3>
                <p style="margin: 0; color: rgba(255,255,255,0.8);">Manage footer content</p>
                <a href="{{ route('admin.footer') }}" style="display: inline-block; margin-top: 1rem; padding: 0.5rem 1rem; background: #ffffff; color: #46305e; text-decoration: none; border-radius: 5px;">Manage</a>
            </div>
        </div>
    </div>
@endsection
