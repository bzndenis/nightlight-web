@extends('admin.layout')

@section('content')
    <div class="admin-header" data-aos="fade-down">
        <h1>Dashboard</h1>
    </div>

    <div class="card" data-aos="fade-up">
        <h2>Welcome to NightLight Admin Dashboard</h2>
        <p style="font-size: 1.6rem; color: #666; line-height: 1.8;">Manage your website content from here. Use the sidebar to navigate to different sections.</p>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 2rem; margin-top: 3rem;">
            <div style="background: linear-gradient(135deg, #46305e 0%, #8815d8 100%); color: #ffffff; padding: 2.5rem; border-radius: 16px; text-align: center; box-shadow: 0 10px 30px rgba(70, 48, 94, 0.3); transition: all 0.3s ease; cursor: pointer;" data-aos="fade-up" data-aos-delay="100" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 15px 40px rgba(70, 48, 94, 0.4)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 30px rgba(70, 48, 94, 0.3)';">
                <div style="font-size: 4rem; margin-bottom: 1rem;">📢</div>
                <h3 style="margin: 0 0 1rem 0; color: #ffffff; font-family: 'montserrat-bold', sans-serif; font-size: 1.8rem;">Announcement</h3>
                <p style="margin: 0; color: rgba(255,255,255,0.9); font-size: 1.4rem;">Manage announcement content</p>
                <a href="{{ route('admin.announcement') }}" style="display: inline-block; margin-top: 1.5rem; padding: 0.8rem 2rem; background: rgba(255,255,255,0.2); color: #ffffff; text-decoration: none; border-radius: 25px; border: 2px solid rgba(255,255,255,0.3); transition: all 0.3s ease; font-family: 'montserrat-semibold', sans-serif;">Manage</a>
            </div>
            
            <div style="background: linear-gradient(135deg, #8815d8 0%, #a855f7 100%); color: #ffffff; padding: 2.5rem; border-radius: 16px; text-align: center; box-shadow: 0 10px 30px rgba(136, 21, 216, 0.3); transition: all 0.3s ease; cursor: pointer;" data-aos="fade-up" data-aos-delay="200" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 15px 40px rgba(136, 21, 216, 0.4)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 30px rgba(136, 21, 216, 0.3)';">
                <div style="font-size: 4rem; margin-bottom: 1rem;">🖼️</div>
                <h3 style="margin: 0 0 1rem 0; color: #ffffff; font-family: 'montserrat-bold', sans-serif; font-size: 1.8rem;">Gallery</h3>
                <p style="margin: 0; color: rgba(255,255,255,0.9); font-size: 1.4rem;">Manage gallery images</p>
                <a href="{{ route('admin.gallery') }}" style="display: inline-block; margin-top: 1.5rem; padding: 0.8rem 2rem; background: rgba(255,255,255,0.2); color: #ffffff; text-decoration: none; border-radius: 25px; border: 2px solid rgba(255,255,255,0.3); transition: all 0.3s ease; font-family: 'montserrat-semibold', sans-serif;">Manage</a>
            </div>
            
            <div style="background: linear-gradient(135deg, #46305e 0%, #8815d8 100%); color: #ffffff; padding: 2.5rem; border-radius: 16px; text-align: center; box-shadow: 0 10px 30px rgba(70, 48, 94, 0.3); transition: all 0.3s ease; cursor: pointer;" data-aos="fade-up" data-aos-delay="300" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 15px 40px rgba(70, 48, 94, 0.4)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 30px rgba(70, 48, 94, 0.3)';">
                <div style="font-size: 4rem; margin-bottom: 1rem;">👥</div>
                <h3 style="margin: 0 0 1rem 0; color: #ffffff; font-family: 'montserrat-bold', sans-serif; font-size: 1.8rem;">Team</h3>
                <p style="margin: 0; color: rgba(255,255,255,0.9); font-size: 1.4rem;">Manage team members</p>
                <a href="{{ route('admin.team') }}" style="display: inline-block; margin-top: 1.5rem; padding: 0.8rem 2rem; background: rgba(255,255,255,0.2); color: #ffffff; text-decoration: none; border-radius: 25px; border: 2px solid rgba(255,255,255,0.3); transition: all 0.3s ease; font-family: 'montserrat-semibold', sans-serif;">Manage</a>
            </div>
            
            <div style="background: linear-gradient(135deg, #8815d8 0%, #a855f7 100%); color: #ffffff; padding: 2.5rem; border-radius: 16px; text-align: center; box-shadow: 0 10px 30px rgba(136, 21, 216, 0.3); transition: all 0.3s ease; cursor: pointer;" data-aos="fade-up" data-aos-delay="400" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 15px 40px rgba(136, 21, 216, 0.4)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 30px rgba(136, 21, 216, 0.3)';">
                <div style="font-size: 4rem; margin-bottom: 1rem;">📝</div>
                <h3 style="margin: 0 0 1rem 0; color: #ffffff; font-family: 'montserrat-bold', sans-serif; font-size: 1.8rem;">Footer</h3>
                <p style="margin: 0; color: rgba(255,255,255,0.9); font-size: 1.4rem;">Manage footer content</p>
                <a href="{{ route('admin.footer') }}" style="display: inline-block; margin-top: 1.5rem; padding: 0.8rem 2rem; background: rgba(255,255,255,0.2); color: #ffffff; text-decoration: none; border-radius: 25px; border: 2px solid rgba(255,255,255,0.3); transition: all 0.3s ease; font-family: 'montserrat-semibold', sans-serif;">Manage</a>
            </div>
        </div>
    </div>
@endsection
