/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ["Montserrat", "sans-serif"]
      },
      gridTemplateColumns: {
        '60/40': '60% 38%'
      },
      colors: {
        pumpkin: {
          '50': 'hsl(15, 87%, 95%)',
          '100': 'hsl(15, 87%, 90%)',
          '200': 'hsl(15, 87%, 85%)',
          '300': '#F9A31C',
          '400': 'hsl(15, 87%, 65%)',
          '550': '#EA7817',
          '500': 'hsl(15, 87%, 55%)',
          '600': 'hsl(15, 87%, 45%)',
          '700': 'hsl(15, 87%, 35%)',
          '800': 'hsl(15, 87%, 25%)',
          '900': 'hsl(15, 87%, 15%);'
        },
        marine: {
          '50': 'hsl(219, 62%, 95%)',
          '100': 'hsl(219, 62%, 90%)',
          '200': 'hsl(219, 62%, 80%)',
          '300': 'hsl(219, 62%, 70%)',
          '400': 'hsl(219, 62%, 60%)',
          '500': 'hsl(219, 62%, 50%)',
          '600': 'hsl(219, 62%, 40%)',
          '700': 'hsl(219, 62%, 30%)',
          '800': 'hsl(219, 62%, 20%)',
          '900': 'hsl(219, 62%, 10%);'
        },
        background: 'hsl(var(--background))',
        foreground: 'hsl(var(--foreground))',
        card: {
          DEFAULT: 'hsl(var(--card))',
          foreground: 'hsl(var(--card-foreground))'
        },
        popover: {
          DEFAULT: 'hsl(var(--popover))',
          foreground: 'hsl(var(--popover-foreground))'
        },
        primary: {
          DEFAULT: 'hsl(var(--primary))',
          foreground: 'hsl(var(--primary-foreground))'
        },
        secondary: {
          DEFAULT: 'hsl(var(--secondary))',
          foreground: 'hsl(var(--secondary-foreground))'
        },
        muted: {
          DEFAULT: 'hsl(var(--muted))',
          foreground: 'hsl(var(--muted-foreground))'
        },
        accent: {
          DEFAULT: 'hsl(var(--accent))',
          foreground: 'hsl(var(--accent-foreground))'
        },
        destructive: {
          DEFAULT: 'hsl(var(--destructive))',
          foreground: 'hsl(var(--destructive-foreground))'
        },
        border: 'hsl(var(--border))',
        input: 'hsl(var(--input))',
        ring: 'hsl(var(--ring))',
        chart: {
          '1': 'hsl(var(--chart-1))',
          '2': 'hsl(var(--chart-2))',
          '3': 'hsl(var(--chart-3))',
          '4': 'hsl(var(--chart-4))',
          '5': 'hsl(var(--chart-5))',
          '1': 'hsl(var(--chart-1))',
          '2': 'hsl(var(--chart-2))',
          '3': 'hsl(var(--chart-3))',
          '4': 'hsl(var(--chart-4))',
          '5': 'hsl(var(--chart-5))'
        }
      },
      borderRadius: {
        lg: 'var(--radius)',
        md: 'calc(var(--radius) - 2px)',
        sm: 'calc(var(--radius) - 4px)'
      }
    }
  },
  plugins: [],
}