# NightLight Homepage Redesign - Design Specification

**Date**: 2026-05-08  
**Project**: NightLight Guild Website Homepage  
**Design Concept**: Celestial Night Journey

---

## 1. Concept & Vision

A warm, nostalgic fantasy-MMORPG aesthetic inspired by Ragnarok Online's iconic visual language. The homepage embodies the guild's name "NightLight" - a beacon of warmth and camaraderie in the darkness. The experience feels like standing in a forest clearing during golden hour, with floating ember particles and warm light rays creating an immersive, dramatic atmosphere that is both nostalgic and modern.

---

## 2. Color Palette

| Token | Hex | Usage |
|-------|-----|-------|
| `--bg-primary` | `#1a1410` | Deep warm brown - main background |
| `--bg-secondary` | `#2d2319` | Lighter warm brown - cards, containers |
| `--bg-tertiary` | `#3d3225` | Subtle containers, hover states |
| `--accent-primary` | `#f5a623` | Warm amber/gold - primary accent |
| `--accent-secondary` | `#ffd700` | Bright gold - highlights, glows |
| `--accent-tertiary` | `#c9a86c` | Muted gold - subtle elements |
| `--text-primary` | `#f8f4e8` | Warm cream white - headings |
| `--text-secondary` | `#a89880` | Muted warm gray - body text |
| `--glow-amber` | `rgba(245, 166, 35, 0.4)` | Glow effect color |
| `--glow-gold` | `rgba(255, 215, 0, 0.3)` | Intense glow color |

---

## 3. Typography

- **Display Font**: Cinzel (Google Fonts) - Elegant fantasy serif for headings
- **Body Font**: Nunito Sans (Google Fonts) - Clean, readable sans-serif
- **Fallbacks**: Georgia, serif / system-ui, sans-serif

**Font Sizes**:
- Hero H1: 5rem (clamp: 3rem - 6rem)
- Section H2: 3rem
- Body: 1.6rem
- Small: 1.4rem

---

## 4. Animation System

### 4.1 Ambient Animations
- **Ember Particles**: 25-30 particles floating upward slowly, varying sizes (3-8px), opacity 0.3-0.7, animation duration 8-15s
- **Background Glow Pulse**: Subtle radial gradient that pulses every 4s
- **Warm Light Rays**: CSS gradient overlay with slow animation from top

### 4.2 Entrance Animations
- **Staggered Reveal**: Each section element fades in + slides up (translateY: 30px → 0)
- **Delay**: 100-150ms between sibling elements
- **Duration**: 0.8s per element
- **Easing**: cubic-bezier(0.25, 0.46, 0.45, 0.94)

### 4.3 Hover Animations
- **Scale**: 1.03-1.05 on card/button hover
- **Glow**: box-shadow with `--glow-amber`, blur 20-30px
- **Duration**: 0.3s ease

### 4.4 Scroll Animations
- **Parallax Layers**: Hero background moves at 0.5x scroll speed
- **Fade In on Scroll**: Elements reveal when entering viewport (IntersectionObserver)
- **Threshold**: 0.1 (10% visible before trigger)

### 4.5 Continuous Animations
- **Hero Breathing**: Main hero container scales subtly (1.0 → 1.01) on 4s loop
- **Button Pulse**: CTA buttons have subtle glow pulse on 3s loop
- **Border Gradient**: Rotating gradient border on avatar frames (3s rotation)

---

## 5. Layout & Structure

### 5.1 Page Flow
1. **Header** - Fixed, transparent → solid on scroll
2. **Hero** - 100vh, layered parallax
3. **About** - Warm gradient transition
4. **Announcement** - Centered banner
5. **Gallery** - Horizontal carousel
6. **Team** - 5-column grid
7. **Footer** - Warm gradient

### 5.2 Responsive Breakpoints
- Desktop: 1200px+
- Tablet: 768px - 1199px
- Mobile: < 768px

### 5.3 Spacing System
- Section padding: 8rem vertical
- Container max-width: 1400px
- Grid gap: 2rem
- Card padding: 2rem

---

## 6. Component Specifications

### 6.1 Header/Navigation
- **Height**: 72px fixed
- **Background**: Transparent → `#1a1410` on scroll (with transition)
- **Logo**: Text with warm glow text-shadow
- **Nav Links**: Color `#a89880`, hover `#f5a623`, underline animation left-to-right
- **CTA Button**: Amber background with hover glow

### 6.2 Hero Section
- **Height**: 100vh, min-height 700px
- **Background**: Layered:
  - Base: `#1a1410`
  - Gradient overlay: radial warm glow from top-center
  - Light rays: linear gradient from top
- **Particles**: Absolutely positioned, z-index 1
- **Content**: Centered or left-aligned, max-width 600px
- **H1**: Letter-by-letter reveal animation
- **Subtext**: Fade-in after H1 completes
- **Buttons**: Staggered entrance, hover scale + glow

### 6.3 About Section
- **Background**: Gradient from `#1a1410` to `#2d2319`
- **Decorative Border**: Animated corners (CSS border-image or pseudo-elements)
- **Content**: Two-column (image + text) on desktop, stacked on mobile
- **Text Reveal**: Per-paragraph staggered animation

### 6.4 Announcement Banner
- **Container**: Glass-morphism with amber tint (`rgba(245, 166, 35, 0.1)`)
- **Border**: 1px solid `rgba(245, 166, 35, 0.3)`
- **Background**: Shimmer animation (moving gradient highlight)
- **Icon**: Bounce animation loop
- **Text**: Warm cream with subtle text-shadow glow

### 6.5 Gallery Section
- **Container**: Full-width with horizontal scroll
- **Cards**: 
  - Aspect ratio 1:1 (square)
  - Size: 300px × 300px (flex, 33.333% - gap)
  - Border-radius: 16px
  - Box-shadow: `0 10px 30px rgba(0,0,0,0.15)`
- **Hover State**: 
  - Transform: translateY(-12px) scale(1.03)
  - Box-shadow: warm amber glow
  - Overlay: fade in with icon
- **Navigation**: Custom arrows with warm styling
- **Auto-scroll**: Slow horizontal scroll with momentum
- **Lightbox**: Full-screen modal with image preview

### 6.6 Team Section
- **Layout**: CSS Grid, 5 columns (responsive: 3 → 2 → 1)
- **Role Card**:
  - Background: glass-morphism (`rgba(45, 35, 25, 0.7)`)
  - Backdrop-filter: blur(10px)
  - Border: 2px solid `#3d3225`, hover → amber
  - Border-radius: 16px
  - Padding: 2rem
- **Avatar**:
  - Size: 90px × 90px
  - Border: 4px solid white
  - Frame: Animated gradient border (rotating)
- **Hover State**: 
  - Card lifts (translateY: -8px)
  - Glow intensifies
- **Empty State**: Dashed border, muted colors

### 6.7 Footer
- **Background**: Gradient to darker brown
- **Social Icons**: Hover glow effect
- **Links**: Underline animation
- **Copyright**: Fade-in animation

### 6.8 Global UI Elements
- **Scroll Progress**: Fixed bar at top, amber color
- **Back to Top Button**: Fixed bottom-right, warm glow on hover
- **Page Load Transition**: Full-screen warm gradient fade-out

---

## 7. Technical Implementation Notes

### 7.1 CSS Approach
- CSS Variables for all colors and spacing
- CSS Animations (@keyframes) for all animations
- CSS Grid for layouts
- Flexbox for component alignment
- No external animation libraries (pure CSS)

### 7.2 JavaScript Features
- IntersectionObserver for scroll-triggered animations
- Manual horizontal scroll with momentum (mouse drag + touch)
- Lightbox functionality
- Header scroll state
- Particle system (CSS-only or minimal JS)

### 7.3 Performance Considerations
- Use `transform` and `opacity` for animations (GPU accelerated)
- Lazy load gallery images
- Debounce scroll events
- Use `will-change` sparingly

### 7.4 Accessibility
- Reduced motion media query support
- Focus states visible
- Semantic HTML structure
- Alt text for images

---

## 8. Content Placeholders

| Section | Title | Content |
|---------|-------|---------|
| Hero | Welcome to NightLight Guild | United by Friendship and Teamwork |
| About | A Little About NightLight Guild | Guild description text |
| Announcement | [Dynamic] | [Dynamic from DB] |
| Gallery | Our Gallery | Gallery description |
| Team | Meet the NightLight Team | Role-based member grid |

---

## 9. Out of Scope

- Dark mode toggle (single warm dark theme only)
- Multi-language support
- Interactive chat/comments
- User authentication flows
- Complex animations on mobile (reduced motion)

---

## 10. Success Criteria

- [ ] Warm nostalgic aesthetic visible throughout
- [ ] Maximum drama with consistent animations
- [ ] Celestial Night Journey ambiance achieved
- [ ] All sections have entrance animations
- [ ] Hover states feel satisfying and responsive
- [ ] Mobile-friendly with graceful degradation
- [ ] Page load under 3 seconds
- [ ] No layout shifts after load
